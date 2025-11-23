@extends('emails.partials.app')
@section('containt')
    <!-- Header -->
    <div class="header">
        <h1>عقد الخدمة</h1>
        <p>نظام إدارة العقود الإلكترونية</p>
    </div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-value">مرحباً بك، {{ $user->name }}</div>
        </div>


        <div class="info-item">
            <div class="info-label">نشكر لك ثقتك في خدماتنا. يسعدنا التعاون معك.
                يسرنا إرسال عقد الخدمة الخاص بك. يرجى اتباع الخطوات التالية لإتمام العملية:</div>
            <div class="steps">
                <div class="step">
                    <div class="step-number"></div>
                    <div class="step-text">قم بتحميل المستندات المرفقة أدناه</div>
                </div>
                <div class="step">
                    <div class="step-number"></div>
                    <div class="step-text">راجع العقد وصيغة الوكالة بعناية</div>
                </div>
                <div class="step">
                    <div class="step-number"></div>
                    <div class="step-text">قم بالتوقيع على النسخ الأصلية</div>
                </div>
                <div class="step">
                    <div class="step-number"></div>
                    <div class="step-text">ارفع العقد الموقّع عبر الرابط أدناه</div>
                </div>
            </div>
        </div>

        <div class="divider"></div>


        <div class="info-item">
            <div class="info-label"> <span class="icon">📎</span>
                المستندات المرفقة:</div>
            <div class="info-value">
                <div class="documents">
                    <a href="{{ $contractLink }}" class="document-item">
                        <div class="document-icon"></div>
                        <div class="document-info">
                            <div class="document-title">عقد الخدمة</div>
                            <div class="document-desc">العقد الرئيسي المطلوب توقيعه</div>
                        </div>
                    </a>


                    <a href="{{ url('contracts/AgencyForm.docx') }}" class="document-item">
                        <div class="document-icon"></div>
                        <div class="document-info">
                            <div class="document-title">صيغة الوكالة</div>
                            <div class="document-desc">المستند التكميلي للعقد</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="info-item">
            <div class="cta-container">
                <a href="{{ $uploadLink }}" class="button">
                    ⬆️ رفع العقد
                </a>
            </div>
        </div>
    </div>
@endsection