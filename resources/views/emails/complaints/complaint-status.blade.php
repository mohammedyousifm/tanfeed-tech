@extends('emails.partials.app')
@section('containt')
    <div class="header">
        <h1>تم تحديث حالة الطلب</h1>
        <p>رقم الطلب {{ $complaint->serial_number }}</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">الحالة السابقة</div>
            <div class="info-value">{{ $oldLabel }}</div>
        </div>


        <div class="info-item">
            <div class="info-label">الحالة الجديدة:</div>
            <div class="info-value">{{ $newLabel ?? 'غير محدد' }}</div>
        </div>
        @if ($newLabel === 'معلق')
            <div class="info-item">
                <div class="info-label">سبب التعليق:</div>
                <div class="info-value">{{ $suspendedReason }}</div>
            </div>
        @endif
        <div class="info-item">
            <div class="cta-container">
                <a href="{{ route('merchant.complaints.show', $complaint->id) }}" class="button">
                    عرض الطلب
                </a>
            </div>
        </div>
    </div>
@endsection