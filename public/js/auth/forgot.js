$(document).ready(function () {
    $('.input-group-text').children('i').hide()
    // mặc đinh icon show pass sẽ ẩn
})


function send_mail_reset() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var frm = $('.frm_reset_pass')
    var email = frm.find('input[name=email]').val();
    $.ajax({
        type: 'post',
        url: routeSendMail,
        data: {
            email: email,
        },
        dataType: "json",
        beforeSend: function () {
            if (frm.length) {
                frm.find('button').text("Đang xử lý...").prop('disabled', true);
            }
        },
        success: function (res) {
            if (res.status === 400) {
                if (res.errors.email) {
                    toastr.error(res.errors.email);
                    frm.find('button').text("Xác nhận").removeAttr('disabled');
                }
                if (res.errors.fail) {
                    toastr.error(res.errors.fail);
                    frm.find('button').text("Xác nhận").removeAttr('disabled');
                }
            }
            if (res.status === 200) {
                Swal.fire({
                    title: 'Thông báo',
                    text: res.success.msg,
                    backdrop: true,
                    timer: 3500,
                    showConfirmButton: false,
                    buttonsStyling: false,
                });
                setTimeout(function () {
                    var startTime =  new Date().getTime();
                    localStorage.setItem("countdownStartTime", startTime);
                    // lưu thoi gian hien tại vào localStorage để có thể kiểm tra thời hạn code
                    window.location = routeformCode
                }, 4000);
                frm.find('button').text("Xác nhận").removeAttr('disabled');
            }

        }
    })
}



function reset_pass() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var frm = $('.frm_reset_pass')
    var passwordInput = frm.find('input[name=password]');
    var password = passwordInput.val();

    var confirm_passwordInput = frm.find('input[name=confirm_password]');
    var confirm_password = confirm_passwordInput.val();

    $.ajax({
        type: 'post',
        url:routeSaveResetPass,
        data: {
            password: password,
            confirm_password:confirm_password
        },
        success: function (res) {
            if (res.status === 400) {
                if (res.errors.confirm_password) {
                    confirm_passwordInput.addClass('error')
                    $('.pass-cf').css('border-color', 'red')
                    toastr.error(res.errors.confirm_password);
                    confirm_passwordInput.on('focus', function (){
                        confirm_passwordInput.addClass('error')
                        $('.pass-cf').css('border-color', '#666cff')
                    })
                    confirm_passwordInput.on('blur', function() {
                        $('.pass-cf').css('border-color', 'red')
                        $('.invalid-feedback-cf-pw').hide();
                    });
                }else {
                    confirm_passwordInput.on('focus', function (){
                        $('.pass-cf').css({'border-color': null})
                        confirm_passwordInput.removeClass('error')
                    })
                    confirm_passwordInput.on('blur', function() {
                        $('.pass-cf').removeAttr('style')
                    });
                    $('.pass-cf').removeAttr('style')
                    confirm_passwordInput.removeClass('error')
                }
                //end pw_cf

                if (res.errors.password) {
                    passwordInput.addClass('error')
                    $('.pass').css('border-color', 'red')
                    toastr.error(res.errors.confirm_password);
                    passwordInput.on('focus', function (){
                        passwordInput.addClass('error')
                        $('.pass').css('border-color', '#666cff')
                    })
                    passwordInput.on('blur', function() {
                        $('.pass').css('border-color', 'red')
                        $('.invalid-feedback-pw').hide();
                    });
                }else {
                    passwordInput.on('focus', function (){
                        passwordInput.removeClass('error')
                        $('.pass').css({'border-color': null})
                    })
                    passwordInput.on('blur', function() {
                        $('.pass').removeAttr('style')
                    });
                    $('.pass').removeAttr('style')
                    passwordInput.removeClass('error')
                }
                //end password
            }
            if (res.status === 200) {
                toastr.info('Thay đổi mật khẩu thành công!');
                setTimeout(function (){
                    window.location = routeAdminAccount
                }, 500)
            }
        }
    })
}


var passwordInput = document.querySelector('input[name="password"]');
var toggleButton = document.querySelector('.input-group-text');


toggleButton.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.innerHTML = '<i class="mdi mdi-eye-outline"></i>';
    } else {
        passwordInput.type = 'password';
        toggleButton.innerHTML = '<i class="mdi mdi-eye-off-outline"></i>';
    }
});

var passwordCfInput = document.querySelector('input[name="confirm_password"]');
var toggleButtonCf = document.querySelector('.cursor-pointer-cf');


toggleButtonCf.addEventListener('click', function () {
    if (passwordCfInput.type === 'password') {
        passwordCfInput.type = 'text';
        toggleButtonCf.innerHTML = '<i class="mdi mdi-eye-outline"></i>';
    } else {
        passwordCfInput.type = 'password';
        toggleButtonCf.innerHTML = '<i class="mdi mdi-eye-off-outline"></i>';
    }
});
// end show pass



var passwordInputs = $('#password-input');
var passwordInputcfs = $('#password-input-cf');
function checkPassword() {
    var pass = passwordInputs.val()
    var pass_cf = passwordInputcfs.val();
    if (pass === "") {
        $('.pass').children('i').hide()
    } else {
        $('.pass').children('i').show()
    }
    if (pass_cf === "") {
        $('.pass-cf').children('i').hide()
    } else {
        $('.pass-cf').children('i').show()
    }

}





