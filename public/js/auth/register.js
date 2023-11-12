$(document).ready(function () {
    $('.input-group-text').children('i').hide()
})


function checkRegiter() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var frm = $('#frm_check_regiter')
    var nameInput = frm.find('input[name=name]');
    var name = nameInput.val();

    var emailInput = frm.find('input[name=email]');
    var email = emailInput.val();

    var passwordInput = frm.find('input[name=password]');
    var password = passwordInput.val();

    var password_confirmInput = frm.find('input[name=password_confirm]');
    var password_confirm = password_confirmInput.val();

    var phoneInput = frm.find('input[name=phone]');
    var phone = phoneInput.val();

    var addressInput = frm.find('input[name=address]');
    var address = addressInput.val();

    var province = frm.find('select[name=province]').val();
    var district = frm.find('select[name=district]').val();
    var wards = frm.find('select[name=wards]').val();



    $.ajax({
        type: "Post",
        url: routeCheckRegiter,
        data: {
            name:name,
            email: email,
            password: password,
            password_confirm:password_confirm,
            phone:phone,
            address:address,
            province:province,
            district:district,
            wards:wards
        },
        dataType: "json",
        success: function (res) {
            if (res.status === 200) {
                toastr.info('Đăng kí tài khoản thành công!');
                setTimeout(function (){
                    window.location = routeAdminAccount
                }, 500)
            }
            if (res.status === 400) {
                 if (res.errors.address){
                     addressInput.addClass('error')
                     toastr.error(res.errors.address);
                     addressInput.on('focus', function (){
                         addressInput.addClass('error')
                     })
                     addressInput.on('blur', function() {
                         $('.invalid-feedback-addreess').hide();
                     });
                 }else{
                     addressInput.on('focus', function (){
                         phoneInput.removeClass('error')
                     })
                     addressInput.removeClass('error')
                 }

                if (res.errors.phone) {
                    phoneInput.addClass('error')
                    toastr.error(res.errors.phone);
                    phoneInput.on('focus', function (){
                        phoneInput.addClass('error')
                   })
                    phoneInput.on('blur', function() {
                        $('.invalid-feedback-phone').hide();
                    });
                }else {
                    phoneInput.on('focus', function (){
                        phoneInput.removeClass('error')
                    })
                    phoneInput.removeClass('error')
                }
                //end phone

                if (res.errors.password_confirm) {
                    password_confirmInput.addClass('error')
                    $('.input-group-text').css('border-color', 'red')
                    toastr.error(res.errors.password_confirm);
                    password_confirmInput.on('focus', function (){
                        password_confirmInput.addClass('error')
                        $('.pass-cf').css('border-color', '#666cff')
                    })
                    password_confirmInput.on('blur', function() {
                        $('.input-group-text').css('border-color', 'red')
                        $('.invalid-feedback-cf-pw').hide();
                    });
                }else {
                    password_confirmInput.on('focus', function (){
                        $('.input-group-text').css({'border-color': null})
                        password_confirmInput.removeClass('error')
                    })
                    password_confirmInput.on('blur', function() {
                        $('.input-group-text').removeAttr('style')
                    });
                    $('.input-group-text').removeAttr('style')
                    password_confirmInput.removeClass('error')
                }
                //end pw_cf

                if (res.errors.password) {
                    passwordInput.addClass('error')
                    $('.input-group-text').css('border-color', 'red')
                    toastr.error(res.errors.password);
                    passwordInput.on('focus', function (){
                        passwordInput.addClass('error')
                        $('.pass').css('border-color', '#666cff')
                    })
                    passwordInput.on('blur', function() {
                        $('.input-group-text').css('border-color', 'red')
                        $('.invalid-feedback-pw').hide();
                    });
                }else {
                    passwordInput.on('focus', function (){
                        passwordInput.removeClass('error')
                        $('.input-group-text').css({'border-color': null})
                    })
                    passwordInput.on('blur', function() {
                        $('.input-group-text').removeAttr('style')
                    });
                    $('.input-group-text').removeAttr('style')
                    passwordInput.removeClass('error')
                }
                //end password

                if (res.errors.email) {
                    emailInput.addClass('error')
                    toastr.error(res.errors.email);
                    emailInput.on('focus', function (){
                        emailInput.addClass('error')
                    })
                    emailInput.on('blur', function() {
                        $('.invalid-feedback-email').hide();
                    });
                }else {
                    emailInput.on('focus', function (){
                        emailInput.removeClass('error')
                    })
                    emailInput.removeClass('error')
                }
                // end email

                if (res.errors.name) {
                    nameInput.addClass('error')
                    toastr.error(res.errors.name);
                    nameInput.on('focus', function (){
                        nameInput.addClass('error')
                    })
                    nameInput.on('blur', function() {
                        $('.invalid-feedback-name').hide();
                    });
                }else {
                    nameInput.on('focus', function (){
                        nameInput.removeClass('error')
                    })
                    nameInput.removeClass('error')
                }
                //end namw
            }
        }
    })
}
// end dang ki


$.getJSON("https://provinces.open-api.vn/api/p/", function(provinces) {
    var provinceSelect = $("#province");
    provinceSelect.empty();
    provinceSelect.append("<option value='trống'>Chọn tỉnh/thành</option>");
    $.each(provinces, function(i, province) {
        provinceSelect.append("<option data-id='"+ province.code + "'  value='" + province.name + "'>" + province.name + "</option>");
    });
});

$("#province").change(function() {
    var provinceId = $(this).find(':selected').data('id');
    $("#district").empty();
    $("#ward").empty();
    $("#district").append("<option value='trống'>Chọn quận/huyện</option>"); // Thêm dòng này để reset option quận/huyện về giá trị mặc định
    $("#ward").append("<option value='trống'>Chọn phường/xã</option>"); // Thêm dòng này để reset option phường/xã về giá trị mặc định
    axios.get("https://provinces.open-api.vn/api/p/" + provinceId + "?depth=2")
        .then(function(response) {

            var districtSelect = $("#district");

            $.each(response.data.districts, function(i, district) {
                districtSelect.append("<option data-id='"+ district.code + "' value='" + district.name + "'>" + district.name + "</option>");
            });
        })
        .catch(function(error) {
            console.log(error);
        });
});


$("#district").change(function() {
    var districtId =  $(this).find(':selected').data('id');

    $("#ward").empty(); // Reset danh sách phường/xã
    $("#ward").append("<option value='trống'>Chọn phường/xã</option>");
    axios.get("https://provinces.open-api.vn/api/d/" + districtId + "?depth=2")
        .then(function(response) {
            var wardSelect = $("#ward");
            $.each(response.data.wards, function(i, ward) {
                wardSelect.append("<option data-id='" + ward.code + "' value='" + ward.name + "'>" + ward.name + "</option>");
            });
        })
        .catch(function(error) {
            console.log(error);
        });
});
// API địa chỉ



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
// end show pass

var passwordCfInput = document.querySelector('input[name="password_confirm"]');
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
