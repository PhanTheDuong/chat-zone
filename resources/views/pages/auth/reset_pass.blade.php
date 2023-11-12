<?php
use App\Models\Setting;
$setting = Setting::select('*')->first();
?>
@component('mail::message')
    <div style="background-color: #f8f8f8; padding: 20px;">
        <h1 style="color: #333;">Xin chào {{$user}},</h1>
        <p>Bạn đã gửi yêu cầu lấy lại mật khẩu tài khoản cá nhân tại website <a href="https://strava.geckoso.com">strava.geckoso.com</a></p>
        <h2 >Mã xác nhận của bạn là: <span style="font-weight: bold; color: #333;">{{ $code }}</span></h2>
        <p>Lưu ý: Mã có hiệu lực trong vòng 2 phút.</p>
        <p>Nếu bạn có bất kì thắc mắc gì, vui lòng liên hệ với chúng tôi tại Website!</p>
        <br/>
        <p>Địa chỉ: G26 đường C22, phường 12, quận Tân Bình, TP. Hồ Chí Minh</p>
        <br>
        <br/>
       <div style="text-align: right">
          <p style="text-align: right">Thân ái,</p>
           <span style="padding-right: 3px">{{$setting->name_web}}</span>
           <br/>
           <i></i>
       </div>
    </div>
@endcomponent
