@extends('emails.partials.app')
@section('containt')
    <div class="header">
        <h1>تم تحديث حالة حسابك</h1>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">الحالة السابقة</div>
            <div class="info-value">{{ $oldLabel   }}</div>
        </div>


        <div class="info-item">
            <div class="info-label">الحالة الجديدة:</div>
            <div class="info-value">{{ $newLabel   }}</div>
        </div>

        <div class="info-item">
            <div class="info-value">{{ $text  }}</div>
        </div>

    </div>
@endsection