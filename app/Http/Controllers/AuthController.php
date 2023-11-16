<?php

namespace App\Http\Controllers;
use App\Models\Password_reset;
use App\Models\User;
use App\Services\AuthSevice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
 protected $authService;

    public function __construct(AuthSevice $authService)
    {
        $this->authService = $authService;
    }

    public function Login()
    {
        $page_title = trans('auth.login');
        return view('pages.auth.login', compact('page_title'));
    }

    public function checkLogin(Request $request)
    {
        $check = $this->authService->checkProcessLogin($request);
        if ($check['success']){
            return response()->json([
                'status' => 200,
                'errors' => $check['message']
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'errors' => $check['message']
            ]);
        }

    }
    /* end login */


    public function Register(){
        $page_title = __('auth.register');
        return view('pages.auth.register', compact('page_title'));
    }

    public function handleRegister(Request $request)
    {
        $check = $this->authService->processRegister($request);

        if ($check['success']){
            return response()->json([
                'status' => 200,
                'errors' => $check['message']
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'errors' => $check['message']
            ]);
        }

    }
    /* end register */

    public function loginGoogle(){
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function loginGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('TV123456'),
            ]);
            Auth::login($newUser, true);
        }
        return redirect()->to('/');
    }
    /* end login google */

    public function forgotPassword()
    {
        $page_title = __('auth.for_got_pass');
        return view('pages.auth.forgot_password', compact('page_title'));
    }

    public function sendMailForgotPassword(Request $request){
      $sendMail =  $this->authService->processSendMailForgotPass($request);
        if ($sendMail['success']){
            return response()->json([
                'status' => 200,
                'success' => $sendMail['message']
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'errors' => $sendMail['message']
            ]);
        }
    }

    public function formCode()
    {
        $page_title = trans('auth.confirm_otp');
        return view('pages.auth.form_code', compact('page_title'));
    }

}
