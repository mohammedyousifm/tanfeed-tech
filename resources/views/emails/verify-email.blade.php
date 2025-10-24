@extends('emails.layout')

@section('content')
    <p>مرحبًا {{ $user->name }}،</p>

    <p>
        نشكرك على التسجيل في <strong>منصة تنفيذ تك</strong>.
        يرجى تأكيد بريدك الإلكتروني بالضغط على الزر أدناه لإكمال عملية التسجيل.
    </p>

    <div style="text-align: center;">
        <a href="{{ $verificationUrl }}" class="btn">تأكيد البريد الإلكتروني</a>
    </div>

    <p>إذا لم تقم بإنشاء هذا الحساب، يمكنك تجاهل هذه الرسالة.</p>
@endsection