function check_code() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var frm = $('.frm_form_code')
    var code = frm.find('input[name=code]').val();
    $.ajax({
        type: 'post',
        url: routeCheckCode,
        data: {
            code: code
        },
        dataType: "json",
        success: function (res) {
            if (res.status === 400) {
                if (res.errors.code) {
                    toastr.error(res.errors.code);
                }
                if (res.errors.fail) {
                    toastr.error(res.errors.fail);
                }
            }
            if (res.status === 200) {
                window.location = routeResetPass
            }
        }
    })
}


// Lấy thời gian bắt đầu từ localStorage (nếu có)
var startTime = localStorage.getItem("countdownStartTime");

var countdownElement = document.getElementById("countdown");
// Lấy thời gian hiện tại
var currentTime = new Date().getTime();

// Nếu không có thông tin về thời gian bắt đầu hoặc đã hết hạn
if (!startTime || currentTime > parseInt(startTime) + 2 * 60 * 1000) {
    countdownElement.innerHTML = "Hết hạn";
} else {
    var expirationTime = parseInt(startTime) + 2 * 60 * 1000;

    // Cập nhật và hiển thị thời gian đếm ngược
    var countdownInterval = setInterval(function() {
        // Lấy thời gian hiện tại
        var now = new Date().getTime();

        // Tính thời gian còn lại
        var remainingTime = expirationTime - now;

            // Tính toán phút và giây từ thời gian còn lại
        var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

        // Hiển thị thời gian đếm ngược
        countdownElement.innerHTML = minutes + " phút " + seconds + " giây";

        // Kiểm tra nếu thời gian đếm ngược đã kết thúc
        if (remainingTime <= 0) {
            clearInterval(countdownInterval);
            countdownElement.innerHTML = "Hết hạn";
            window.location = routeForgotPass
        }
    }, 1000); // Cập nhật thời gian đếm ngược mỗi giây (1000 milliseconds)
}
