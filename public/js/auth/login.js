$(document).ready(function () {
    $('.input-group-text').children('i').hide()
})

function checkLogin() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form = $('.frm_check_login');
    var emailInput = form.find('input[name="email"]');
    var passwordInput = form.find('input[name="password"]');
    var email = emailInput.val();
    var password = passwordInput.val();
    // Xóa lớp 'error' và ẩn thông báo lỗi trước khi kiểm tra lại


    $.ajax({
        type: "POST",
        url: routeCheckLogin,
        data: {
            email: email,
            password: password
        },
        dataType: "json",
        success: function (res) {
            if (res.status === 200) {
                // Xử lý thành công
                toastr.info('Đăng nhập thành công!');
                setTimeout(function (){
                    window.location = routeAdminAccount;
                }, 500)
            }
            if (res.status === 400) {
                if (res.errors.email) {
                    emailInput.addClass('error');
                    toastr.error(res.errors.email);
                    emailInput.on('focus', function () {
                        emailInput.addClass('error');
                    });
                    emailInput.on('blur', function () {
                        $('.invalid-feedback-e').hide();
                    });
                } else {
                    emailInput.on('focus', function () {
                        emailInput.removeClass('error');
                        $('.invalid-feedback-e').addClass('error').hide();
                    });
                }
                if (res.errors.password) {
                    passwordInput.addClass('error')
                    $('.input-group-text').css('border-color', 'red')
                    toastr.error(res.errors.password);
                    passwordInput.on('focus', function (){
                        passwordInput.addClass('error')
                        $('.input-group-text').css('border-color', '#666cff')
                    })
                    passwordInput.on('blur', function() {
                        $('.input-group-text').css('border-color', 'red')
                        $('.invalid-feedback-pw').hide();
                    });
                }else {
                    passwordInput.on('focus', function (){
                        passwordInput.removeClass('error')
                        $('.input-group-text').css({'border-color': null})
                        $('.invalid-feedback-pw').text(res.errors.password).hide();
                    })
                    passwordInput.on('blur', function() {
                        $('.input-group-text').removeAttr('style')
                    });
                    $('.input-group-text').removeAttr('style')
                    passwordInput.removeClass('error')
                }
                //end password
                if (res.errors.fail) {
                    toastr.error(res.errors.fail);

                }
                if (res.errors.not_found) {
                    toastr.error(res.errors.not_found);
                }
            }
        }
    });
}


// Lấy tham chiếu đến các phần tử HTML cần thiết
var passwordInput = document.querySelector('input[name="password"]');
var toggleButton = document.querySelector('.input-group-text');

// Xử lý sự kiện click vào biểu tượng
toggleButton.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleButton.innerHTML = '<i class="mdi mdi-eye-outline"></i>';
    } else {
        passwordInput.type = 'password';
        toggleButton.innerHTML = '<i class="mdi mdi-eye-off-outline"></i>';
    }
});
//end show pass



var passwordInputs = $('#password-input');
function checkPassword() {
    var val = passwordInputs.val()
    if (val === "") {
        $('.input-group-text').children('i').hide()
    } else {
        $('.input-group-text').children('i').show()
    }
}
