<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthSevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}
