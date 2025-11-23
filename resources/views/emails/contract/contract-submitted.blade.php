@extends('emails.partials.app')
@section('containt')
    <div class="header">
        <h1>تم استلام عقد جديد</h1>
        <p>رقم التاجر {{ $user->client_number }}</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">اسم التاجر</div>
            <div class="info-value">{{ $user->name }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">رقم التاجر</div>
            <div class="info-value">{{ $user->client_number ?? 'غير محدد' }}</div>
        </div>

        <div class="info-item">
            <div class="cta-container">
                <a href="{{ route('lawyer.merchant.show', $user->id) }}" class="button">
                    عرض العقد في لوحة التحكم
                </a>
            </div>
        </div>
    </div>
@endsection