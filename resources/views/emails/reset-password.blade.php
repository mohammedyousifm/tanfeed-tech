@extends('emails.layout')

@section('content')
    <p>مرحبًا {{ $user->name }}،</p>

    <p>لقد طلبت إعادة تعيين كلمة المرور الخاصة بك.</p>
    <p>اضغط على الزر أدناه لتعيين كلمة مرور جديدة:</p>

    <div style="text-align: center;">
        <a href="{{ $resetUrl }}" class="btn" style=" display: inline-block;
                background-color: var(--green);
                color: var(--white) !important;
                padding: 12px 32px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: bold;
                font-size: 16px;
                transition: all 0.3s ease;
                box-shadow: 0 4px 10px rgba(29, 153, 66, 0.25);">إعادة تعيين كلمة المرور</a>
    </div>

    <p>إذا لم تطلب هذا الإجراء، يمكنك تجاهل هذه الرسالة بأمان.</p>
@endsection