@extends('emails.partials.app')
@section('containt')
    <div class="header">
        <h1>إعادة تعيين كلمة المرور</h1>
        <p>مرحبًا {{ $user->name }}،</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">
                <p>لقد طلبت إعادة تعيين كلمة المرور الخاصة بك.</p>
                <p>اضغط على الزر أدناه لتعيين كلمة مرور جديدة:</p>
                <p>إذا لم تطلب هذا الإجراء، يمكنك تجاهل هذه الرسالة بأمان.</p>
            </div>
        </div>

        <div class="info-item">
            <div class="cta-container">
                <a href="{{ $resetUrl }}" class="button">
                    إعادة تعيين كلمة المرور
                </a>
            </div>
        </div>
    </div>
@endsection