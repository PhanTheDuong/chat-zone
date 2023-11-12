<?php

use App\Models\Setting;

$setting = Setting::select('*')->first();


?>

@extends('templates.auth.master')
@section('content')
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Logo -->
                <div class="card p-2">
                    <!-- Forgot Password -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="javascript:;" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                 <img src="{{url($setting->logo)}}" alt="">
                </span>
                            <span class="app-brand-text demo text-heading fw-bold">{{$setting->name_web}}</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-2">
                        <h4 style="text-align: center" class="mb-2">Xác thực OTP 🔒</h4>
                        <p class="mb-4">Hệ thống vừa gửi cho bạn tin nhắn có chứa mã xác nhận tài khoản, hãy kiểm tra thiết bị và nhập mã vào ô bên dưới. Xin cảm ơn!</p>
                           <span style="margin-bottom: 5px">Lưu ý: Mã có hiệu lực trong vòng 2 phút.</span>
                        <form class="mb-3 frm_form_code" id="frm_form_code" onsubmit="event.preventDefault(); return check_code()" method="POST">
                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    style="text-align: center"
                                    type="text"
                                    class="form-control"
                                    name="code"
                                    placeholder="Nhập mã xác nhận của bạn"
                                    autofocus/>
                            </div>
                            <div style="text-align: center; padding-bottom: 10px">
                                <span id="countdown" class="text-muted"></span>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Gửi yêu cầu</button>
                        </form>
                        <div class="text-center">
                            <a href="{{url('forgot/password')}}" class="d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                                Quay lại
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
                <img
                    alt="mask"
                    src="{{url('themes/auth/img/illustrations/auth-basic-forgot-password-mask-light.png')}}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-forgot-password-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-forgot-password-mask-dark.png"/>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        var routeCheckCode = "{{route('checkCode')}}"
        var routeResetPass = "{{route('resetPass')}}"
        var routeForgotPass = "{{route('forgotPass')}}"
    </script>
    <script src="{{ url('js/auth/code.js') }}"></script>


@endpush
