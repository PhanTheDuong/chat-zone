<?php

use App\Models\Setting;

$setting = Setting::select('*')->first();


?>

@extends('templates.auth.master')
@section('content')
    <style>
        .error {
            border-color: red;
        }

        .hidden {
            display: block;
        }

        /* Edge Legacy (Microsoft Edge version 18 and earlier) */
        @supports (-ms-ime-align:auto) {
            input[type="password"]::-ms-reveal {
                display: none !important;
            }
        }

        /* Edge Chromium (Microsoft Edge version 79 and later) */
        @supports (-ms-ime-align:auto) and (not (-ms-ime-align:auto)) {
            input[type="password"]::-ms-reveal {
                display: none !important;
            }
        }
    </style>
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="javascript:;" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                 <img src="{{url($setting->logo)}}" alt="">
                </span>
                            <span class="app-brand-text demo text-heading fw-bold">{{$setting->name_web}}</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <!-- Reset Password -->
                    <div class="card-body mt-2">
                        <h4 style="text-align: center" class="mb-2 fw-semibold">Đổi lại mật khẩu 🔒</h4>
                        <p class="mb-4">Mật khẩu mới của bạn phải khác với mật khẩu đã sử dụng trước đó</p>
                        <form id="" class="mb-0 frm_reset_pass" onsubmit="event.preventDefault(); return reset_pass()"
                              method="POST">
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            oninput="checkPassword()"
                                            type="password"
                                            id="password-input"
                                            class="form-control"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password"/>
                                        <label for="password">Mật khẩu mới *</label>

                                    </div>
                                    <span class="input-group-text pass cursor-pointer"
                                          id="multicol-confirm-password2 "><i
                                            class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                                <div class="invalid-feedback-pw"></div>
                                <div id="defaultFormControlHelp" class="form-text">
                                    Mật khẩu mới phải từ 8 đến 64 ký tự, chứa các ký tự a-z, A-Z, và 0-9, không bao gồm
                                    khoảng trắng và tiếng Việt có dấu
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            oninput="checkPassword()"
                                            type="password"
                                            id="password-input-cf"
                                            class="form-control"
                                            name="confirm_password"
                                            onpaste="return false;"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password"/>
                                        <label for="confirm-password">Nhập lại mật khẩu mới *</label>
                                    </div>
                                    <span class="input-group-text pass-cf cursor-pointer-cf"
                                          id="multicol-confirm-password2">
                                    <i class="mdi mdi-eye-off-outline"></i>
                                     </span>
                                </div>
                                <div class="invalid-feedback-cf-pw"></div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-3">Xác nhận</button>
                            <div class="text-center">
                                <a href="{{url('/')}}" class="d-flex align-items-center justify-content-center">
                                    <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                                    Quay lại đăng nhập
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
                <img
                    alt="mask"
                    src="{{url('themes/auth/img/illustrations/auth-basic-reset-password-mask-light.png')}}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-reset-password-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-reset-password-mask-dark.png"/>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var routeAdminAccount = "{{ route('dashboard') }}"
        var routeSaveResetPass = "{{route('saveResetPass')}}"
    </script>
    <script src="{{ url('js/auth/forgot.js') }}"></script>
@endpush
