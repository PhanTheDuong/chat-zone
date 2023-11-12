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
                        <h4 class="mb-2">Quên mật khẩu? 🔒</h4>
                        <p class="mb-4">Nhập email của bạn và chúng tôi sẽ gửi cho bạn hướng dẫn để đặt lại mật khẩu của bạn</p>
                        <form class="mb-3 frm_reset_pass" id="frm_reset_pass" onsubmit="event.preventDefault(); return send_mail_reset()" method="POST">
                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    placeholder="Nhập email của bạn"
                                    autofocus/>
                                <label>Email *</label>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Gửi yêu cầu</button>
                        </form>
                        <div class="text-center">
                            <a href="{{url('/')}}" class="d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                               Quay lại đăng nhập
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
        var routeSendMail = "{{route('sendMail')}}"
        var routeformCode = "{{route('formCode')}}"
    </script>
    <script src="{{ url('js/auth/forgot.js') }}"></script>
@endpush
