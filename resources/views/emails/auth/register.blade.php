@extends('emails.layouts.body')

@section('icon')

    {{--  icon url  --}}
    https://img.icons8.com/fluency/300/null/reading-confirmation.png

@endsection

@section('content')

    {{--  content  --}}
    <h3 style="text-align: center;font-family: cursive;font-style: italic;">مـــــرحبــــــا بــــك</h3>
    <p style="margin-top: 6px;font-family: cursive;color: #2d2d2d;">سعداء لانضمامك لـــروشتــــة سنفعل ما بوسعنا لتقديم للعملاء افضل الخدمات للاستمتاع بافضل المميزات والخدمات الرجاء تفعيل البريد الإلكترونى الخاص بك</p></br>
    <p style="margin-top: 6px;font-family: cursive;">كود تفعيل البريد الإلكترونى</p>
    <h2 style="font-family: cursive;color: red;">{{ $otp }}</h2>
    <p style="margin-top: 10px;font-family: cursive;color: #2d2d2d;"><b style="color: red;">ملاحظة / </b>هذا الكود متاح للاستخدام مرة واحدة فقط</p>

@endsection

