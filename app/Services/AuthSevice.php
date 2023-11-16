<?php

namespace App\Services;


use App\Mail\SendCodeForgotPassEmail;
use App\Models\password_reset;
use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\RegistrationSuccessEmail;
use Illuminate\Support\Facades\Mail;

class AuthSevice
{


    public function checkProcessLogin($request)
    {
        $result = [
            'message' => '',
            'success' => false,
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|max:64'
        ], [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email'),

            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.max' => __('auth.password_max'),
        ]);
        if (!empty($validator->fails())) {
            $result = [
                'message' => $validator->messages(),
                'success' => false,
            ];
            return $result;
        }

        $email = $request->email;
        $password = $request->password;
        $emailCheck = User::where('email', $email)->first();
        if ($emailCheck) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $result['success'] = true;
            } else {
                $result['success'] = false;
                $result['message'] = ['fail' => __('auth.login_fail')];
            }
        } else {
            $result['success'] = false;
            $result['message'] = ['not_found' => __('auth.email_not_found')];
        }

        return $result;
    }

    public function processRegister($request)
    {
        $result = [
            'message' => '',
            'success' => false,
        ];
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:10',
            'name' => 'required|max:128|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:64|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/u',
            'password_confirm' => 'required',
            'address' => 'max:128'
        ], [
            'phone.required' => __('auth.phone_required'),
            'name.regex' => __('auth.name_regex'),
            'name.required' => __('auth.name_required'),
            'name.max' => __('auth.name_max'),

            'email.unique' => __('auth.email_unique'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email'),

            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.max' => __('auth.password_max'),
            'password.regex' => __('auth.password_auth_suitable'),

            'password_confirm.required' => __('auth.password_confirm_required'),
            'password_confirm.required_with' => __('auth.password_confirm_required_with'),
            'password_confirm.same' => __('auth.password_confirm_required_with'),
            'address.max' => __('auth.address_max')
        ]);
        if (!empty($validator->fails())) {
            $result = [
                'message' => $validator->messages(),
                'success' => false,
            ];
        }
        try {
            $save = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'province' => $request->province,
                'district' => $request->district,
                'wards' => $request->wards
            ]);
            DB::commit();
            if ($save) {
                Mail::to($save->email)->queue(new RegistrationSuccessEmail($save));
                Auth::login($save);
                $result = [
                    'message' => 'Tạo tài khoản thành công',
                    'success' => true,
                ];
            } else {
                $result = [
                    'message' => 'Có lỗi xảy ra khi thêm',
                    'success' => false,
                ];
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }

        return $result;
    }

    public function processSendMailForgotPass($request){
        $result = [
            'message' => '',
            'success' => false,
        ];
        DB::beginTransaction();

        $validate = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email')
        ]);

        if ($validate->fails()) {
            $result = [
                'message' => $validate->messages(),
                'success' => false,
            ];
        }
        try {
            $values = $request->post();
            $code = Str::random(12);
            $expiresAt = Carbon::now()->addMinutes(2);

            $row = Password_reset::where("email", $values['email'])->first();

            if (!$row) {
                Password_reset::create([
                    'email' => $values['email'],
                    'code' => $code,
                    'expires_at' => $expiresAt
                ]);
            } else {
                $row->update([
                    'code' => $code,
                    'expires_at' => $expiresAt
                ]);
            }

            $Users = User::select('*')->where('email', $values['email'])->first();
            if (!$Users) {
                $result = [
                    'message' => ['fail' => __('auth.email_not_found')],
                    'success' => false,
                ];
            }
            Mail::to($Users->email)->queue(new sendCodeForgotPassEmail($Users, $code ));
            $result = [
                'message' => ['msg' => __('auth.send_mail_success')],
                'success' => true,
            ];
        }catch (Exception $e){
            Log::error($e);
            DB::rollback();
        }

        return $result;
    }

}
