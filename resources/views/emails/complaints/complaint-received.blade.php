@extends('emails.partials.app')
@section('containt')

    <div class="header">
        <h1>تم استلام طلب جديدة</h1>
        <p>رقم الطلب {{ $complaint->serial_number }}</p>
    </div>

    <div class="info-grid">

        <div class="info-item">
            <div class="info-label">اسم التاجر:</div>
            <div class="info-value">{{ $complaint->user->name }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">اسم العميل:</div>
            <div class="info-value">{{ $complaint->client_name }}</div>
        </div>


        <div class="info-item">
            <div class="cta-container">
                <a href="{{ route('lawyer.complaints.show', $complaint->id) }}" class="button">
                    عرض الطلب
                </a>
            </div>
        </div>
    </div>
@endsection