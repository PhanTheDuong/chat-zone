
@extends('templates.auth.master')
@section('content')
    <style>
        .error {
            border-color: red;
        }

        .hidden {
            display: block;
        }

        ::-ms-reveal {
            display: none;
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
                <!-- Register Card -->
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
                        <h4 class="mb-2 fw-semibold" style="text-align: center">Đăng ký tài khoản 🚀</h4>
                        <p class="mb-4">Đăng ký tài khoản để có thể đăng nhập hệ thống!</p>
                        <form id="frm_check_regiter" onsubmit="event.preventDefault(); return checkRegiter()"
                              class="mb-3" method="POST">
                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    placeholder="Vui lòng nhập tên"
                                    autofocus
                                />
                                <label for="username">Họ tên *</label>
                                <div class="invalid-feedback-name"></div>
                            </div>
                            <div class="form-floating form-floating-outline mb-3">
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Vui lòng nhập email"/>
                                <label for="email">Email *</label>
                                <div class="invalid-feedback-email"></div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            onpaste="return false;"
                                            oninput="checkPassword()"
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            id="password-input"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password"/>
                                        <label for="password">Mật khẩu *</label>
                                    </div>
                                    <span class="input-group-text pass cursor-pointer"
                                          id="multicol-confirm-password2 "><i class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                                <div class="invalid-feedback-pw"></div>
                                <div id="defaultFormControlHelp" class="form-text">
                                    Mật khẩu phải từ 8 đến 64 ký tự, chứa các ký tự a-z, A-Z, và 0-9, không bao gồm
                                    khoảng trắng và tiếng Việt có dấu
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            oninput="checkPassword()"
                                            type="password"
                                            class="form-control"
                                            name="password_confirm"
                                            id="password-input-cf"
                                            onpaste="return false;"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password"
                                        />
                                        <label for="password">Nhập lại mật khẩu *</label>
                                    </div>
                                    <span class="input-group-text pass-cf cursor-pointer-cf"
                                          id="multicol-confirm-password2">
                                    <i class="mdi mdi-eye-off-outline"></i>
                                     </span>
                                </div>
                                <div class="invalid-feedback-cf-pw"></div>
                            </div>

                            <div class="form-floating form-floating-outline mb-3">
                                <input
                                    id="phone-input"
                                    type="tel"
                                    class="form-control"
                                    name="phone"
                                    placeholder="Vui lòng nhập số điện thoại"
                                />
                                <label for="username">Điện thoại *</label>
                                <div class="invalid-feedback-phone"></div>
                            </div>

                            <div style="margin-bottom: 10px" class="row">
                                <div class="form-floating form-floating-outline col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                            id="phone-input"
                                            type="tel"
                                            class="form-control"
                                            name="address"
                                            placeholder="Vui lòng nhập địa chỉ"
                                        />
                                        <label for="email">Địa chỉ</label>
                                        <div class="invalid-feedback-addreess"></div>
                                    </div>
                                </div>
                                <div class="form-floating form-floating-outline col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="province"
                                            name="province"
                                            class="select2 form-select form-select"
                                            data-allow-clear="true">
                                            <option>Chọn tỉnh/thành</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px" class="row">
                                <div class="form-floating form-floating-outline col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="district"
                                            name="district"
                                            class="select2 form-select"
                                            data-allow-clear="true">
                                            <option value='trống'>Chọn quận/huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-floating form-floating-outline col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select
                                            id="ward"
                                            name="wards"
                                            class="select2 form-select"
                                            data-allow-clear="true">
                                            <option value='trống'>Chọn phường/xã</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button style="margin-top: 15px" class="btn btn-primary d-grid w-100">Xác nhận</button>
                        </form>
                        <p class="text-center">
                            <span>Bạn đã có sẵn tài khoản?</span>
                            <a href="{{url('/')}}">
                                <span>Đăng nhập ngay</span>
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

                            <a href="{{url('dang-nhap/google')}}"
                               class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                                <i class="tf-icons mdi mdi-24px mdi-google"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Register Card -->
                <img
                    alt="mask"
                    src="{{url('template/auth/img/illustrations/auth-basic-register-mask-light.png')}}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-register-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-register-mask-dark.png"/>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/addons/cleave-phone.i18n.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
    <script src="{{ url('js/auth/register.js') }}"></script>
    <script>
        {{--var routeAdminAccount = "{{ route('dashboard') }}"--}}
        var routeCheckRegiter = "{{route('auth.handle-register') }}"

        var phoneInput = document.getElementById('phone-input');
        var cleave = new Cleave(phoneInput, {
            phone: true,
            min: 11,
            phoneRegionCode: 'VN',

        });


    </script>

@endpush
