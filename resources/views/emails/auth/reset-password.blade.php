@extends('emails.layouts.body')

@section('icon')

    {{--  icon url  --}}

    https://img.icons8.com/ios-filled/200/22C3E6/keyhole-shield.png

@endsection

@section('content')

    {{--  content  --}}

    <h3 style="text-align: center;font-family: cursive;margin: -20px ;font-style: italic;">مـــــرحبــــــا بــــك</h3>
    <p style="margin-top: 6px;font-family: cursive;color: #2d2d2d;">كود إعادة تعيين كلمة المرور</p></br>
    <h2 style="font-family: cursive;color: red;">{{ $otp }}</h2>
    <p style="margin-top: 10px;font-family: cursive;color: #2d2d2d;"><b style="color: red;">ملاحظة / </b>هذا الكود متاح
        للاستخدام مرة واحدة فقط</p>

@endsection
