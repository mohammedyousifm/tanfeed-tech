@extends('emails.partials.app')
@section('containt')
    <div class="header">
        <h1>تسجيل تاجر جديد - تنفيذ تك</h1>
        <p>تاجر جديد انضم إلى منصة تنفيذ تك</p>
    </div>

    <h3 class="section-title">
        معلومات التاجر
    </h3>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">اسم التاجر</div>
            <div class="info-value">{{ $user->name }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">البريد الإلكتروني</div>
            <div class="info-value">{{ $user->email }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">رقم التاجر</div>
            <div class="info-value">{{ $user->client_number ?? 'لم يتم التعيين بعد' }}</div>
        </div>

        <div class="divider"></div>

        <div class="info-item">
            <div class="cta-container">
                <a href="{{ route('lawyer.merchant.show', $user->id) }}" class="button">
                    عرض ملف التاجر
                </a>
            </div>
        </div>
    </div>
@endsection