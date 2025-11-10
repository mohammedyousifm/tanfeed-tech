<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم رفع عقد جديد</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e8f4f3 100%);
            color: #2d3748;
            font-family: 'Tajawal', Arial, sans-serif;
            direction: rtl;
            text-align: right;
            line-height: 1.7;
        }

        a {
            color: #1B7A75;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #CF9411;
        }

        .wrapper {
            width: 100%;
            padding: 40px 20px;
        }

        .inner-body {
            max-width: 600px;
            background-color: #fff;
            margin: 0 auto;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg, #CF9411 0%, #b88310 100%);
            padding: 30px 40px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .content-cell {
            padding: 45px 40px;
        }

        .alert-box {
            background: linear-gradient(135deg, #e6f7f6 0%, #d1f0ee 100%);
            padding: 25px;
            border-right: 4px solid #1B7A75;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: center;
        }

        .alert-box .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .alert-box h2 {
            color: #1B7A75;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .alert-box p {
            color: #4a5568;
            font-size: 15px;
            margin: 0;
        }

        .info-grid {
            display: grid;
            gap: 15px;
            margin: 30px 0;
        }

        .info-item {
            background: #f7fafc;
            padding: 20px;
            border-radius: 10px;
            border-right: 3px solid #CF9411;
        }

        .info-label {
            color: #718096;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #2d3748;
            font-size: 16px;
            font-weight: 700;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
            margin: 30px 0 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        .section-title .icon {
            color: #CF9411;
            margin-left: 8px;
        }

        .cta-container {
            text-align: center;
            margin: 35px 0;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #1B7A75 0%, #156963 100%);
            color: #fff !important;
            padding: 16px 40px;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(27, 122, 117, 0.3);
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(27, 122, 117, 0.4);
            background: linear-gradient(135deg, #156963 0%, #1B7A75 100%);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to left, transparent, #e2e8f0, transparent);
            margin: 30px 0;
        }

        .note-box {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border-right: 4px solid #CF9411;
            padding: 20px 25px;
            border-radius: 8px;
            margin: 25px 0;
        }

        .note-box .icon {
            color: #CF9411;
            margin-left: 8px;
            font-size: 18px;
        }

        .note-box p {
            color: #78350f;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        .footer {
            background: #2d3748;
            color: #a0aec0;
            text-align: center;
            padding: 30px 40px;
        }

        .footer-content {
            max-width: 500px;
            margin: 0 auto;
        }

        .footer p {
            margin: 8px 0;
            font-size: 13px;
        }

        .footer-links {
            margin: 15px 0;
        }

        .footer-links a {
            color: #a0aec0;
            margin: 0 10px;
            font-size: 13px;
        }

        .footer-links a:hover {
            color: #CF9411;
        }

        @media only screen and (max-width: 600px) {
            .wrapper {
                padding: 20px 10px;
            }

            .content-cell {
                padding: 30px 25px;
            }

            .header {
                padding: 25px 25px;
            }

            .header h1 {
                font-size: 22px;
            }

            .button {
                padding: 14px 30px;
                font-size: 15px;
            }

            .footer {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="inner-body" style="direction: rtl; text-align: right;">
            <!-- Content -->
            <div class="content-cell">
                <!-- Alert Box -->
                <div class="alert-box">
                    <div class="icon">📄</div>
                    <h2>تم استلام عقد جديد</h2>
                    <p>أحد التجار قام برفع عقده الموقّع</p>
                </div>

                <!-- Merchant Info -->
                <h3 class="section-title">
                    <span class="icon">👤</span>
                    معلومات التاجر
                </h3>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">اسم التاجر</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">رقم التاجر</div>
                        <div class="info-value">{{ $user->client_number ?? 'غير محدد' }}</div>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- CTA Button -->
                <div class="cta-container">
                    <a href="{{ route('lawyer.merchant.show', $user->id) }}" class="button">
                        🔍 عرض العقد في لوحة التحكم
                    </a>
                </div>

                <div class="divider"></div>
            </div>

            <!-- Footer -->
            @include('emails.partials.footer')
        </div>
    </div>
</body>

</html>