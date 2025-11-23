@extends('emails.partials.app')
@section('containt')
    <div class="header">
        <h1> تأكيد البريد الإلكتروني</h1>
        <p>مرحبًا {{ $user->name }}،</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <p style="font-size: 16px; color: #555;">
                شكراً لتسجيلك في
                <strong style="color:#1B7A75;">تنفيذ تك</strong> 👋
                يرجى الضغط على الزر أدناه لتأكيد بريدك الإلكتروني وتفعيل حسابك.
            </p>
        </div>

        <div class="info-item">
            <div class="cta-container">
                <a href="{{  $url }}" class="button">
                    تأكيد البريد الإلكتروني
                </a>
            </div>
        </div>
    </div>
@endsection