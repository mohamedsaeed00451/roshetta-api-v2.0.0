@extends('emails.layouts.body')

@section('icon')

    {{--  icon url  --}}
    https://img.icons8.com/material-rounded/200/22C3E6/break.png

@endsection

@section('content')

    {{--  content  --}}
    <h3 style="text-align: center;font-family: cursive;padding: 0px ;font-style: italic;">{{ hi($type) }}</h3>
    <h3 style="text-align: center;font-family: cursive;padding: 0px;font-style: italic;">{{ $name }}</h3>
    <p style="margin-top: 6px;font-family: cursive;color: #2d2d2d;">هل قمت بتسجيل الدخول من جهاز جديد أو موقع جديد
        ؟</p></br>
    <p style="margin-top: 6px;font-family: cursive;color: #2d2d2d;">( {{ mobileDetect('type') }} ) : لأحظنا أن حسابك تم الوصول إلية
        من جهاز </p></br>
    <p style="margin-top: 6px;font-family: cursive;color: #2d2d2d;">( {{ getHostByaddress() }} ) : إسم الجهاز </p></br>
    <p style="margin-top: 6px;font-family: cursive;color: #2d2d2d;">( {{ mobileDetect('operating_system') }} ) : يعمل بنظام </p></br>
    <p style="text-align: center;font-family: cursive;">{{ getIp() }} :(ip) عنوان</p>
    <p style="text-align: center;font-family: cursive;"> {{ date('Y-m-d H:i:s') }} : (بتوقيت القاهرة) التوقيت</p>
    <p style="margin-top: 10px;font-family: cursive;color: #2d2d2d;"><b style="color: red;">ملاحظة / </b>هذة الرسالة ألية برجاء عدم الرد</p>

@endsection

