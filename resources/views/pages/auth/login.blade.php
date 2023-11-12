
@extends('templates.auth.master')
@section('content')
    <style>
        .error {
            border-color: red;
        }

        .hidden {
            display: block;
        }
    </style>
    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">

            <div class="authentication-inner py-4">
                <!-- Login -->
                <div class="card p-2">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mt-5">
                        <a href="javascript:;" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                 <img src="{{url('uploads/logo/icon-logo.png')}}" alt="">
                </span>
                            <span class="app-brand-text demo text-heading fw-bold">Chat Zone</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <div class="card-body mt-2">
                        <h4 class="mb-2 fw-semibold">Chào bạn đến với chat zone! 👋</h4>
                        <p class="mb-4">Vui lòng đăng nhập hoặc đăng ký để truy cập hệ thống</p>

                        <form onsubmit="event.preventDefault(); return checkLogin()" id="formAuthentication "
                              class="mb-3 frm_check_login" method="POST">
                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    placeholder="Vui lòng nhập email"
                                    autofocus/>
                                <label for="email">Email *</label>
                                <div class="invalid-feedback-e"></div>
                            </div>
                            <div class="mb-3">
                                <div class="form-password-toggle">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input
                                                type="password"
                                                class="form-control"
                                                name="password"
                                                id="password-input"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password"
                                                oninput="checkPassword()">
                                            <label for="password">Mật khẩu *</label>
                                        </div>
                                        <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                </div>
                                <div class="invalid-feedback-pw"></div>
                                <div id="defaultFormControlHelp" class="form-text">
                                    Mật khẩu phải từ 8 đến 64 kí tự, chứa các ký tự a-z, A-Z, và 0-9, không bao gồm khoảng trắng và tiếng Việt có dấu
                                </div>
                            </div>
                            <div style="color: red; padding-bottom: 10px" class="invalid-feedback-fail"></div>
                            <div style="color: red ; padding-bottom: 10px" class="invalid-feedback-not_found"></div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me"/>
                                    <label class="form-check-label" for="remember-me"> Nhớ mật khẩu của tôi </label>
                                </div>
                                <a href="{{url('forgot/password')}}" class="float-end mb-1">
                                    <span>Quên mật khẩu?</span>
                                </a>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Xác nhận</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Bạn chưa tài khoản?</span>
                            <a href="{{route('auth.register')}}">
                                <span>Đăng ký tài khoản</span>
                            </a>
                        </p>

                        <div class="divider my-4">
                            <div class="divider-text">hoặc</div>
                        </div>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{url('dang-nhap/facebook')}}" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                                <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                            </a>

                            <a href="{{url('dang-nhap/twitter')}}" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                                <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                                <i class="tf-icons mdi mdi-apple-icloud"></i>
                            </a>

                            <a href="{{url('dang-nhap/google')}}" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                                <i class="tf-icons mdi mdi-24px mdi-google"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <img
                    alt="mask"
                    src="{{url('template/auth/img/illustrations/auth-basic-login-mask-light.png')}}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-login-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-login-mask-dark.png"/>
                <!-- /Login -->

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var routeCheckLogin = "{{ route('auth.check-login') }}"
        {{--var routeAdminAccount = "{{ route('dashboard') }}"--}}
    </script>
    <script src="{{ url('js/auth/login.js') }}"></script>
@endpush
