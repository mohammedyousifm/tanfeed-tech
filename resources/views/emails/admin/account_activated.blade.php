<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تنفيذ تك</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: #f8fafc;
            color: #2d3748;
            font-family: 'Tajawal', Arial, sans-serif;
            direction: rtl;
            text-align: right;
        }

        .wrapper {
            width: 100%;
            padding: 40px 20px;
        }

        .inner-body {
            max-width: 600px;
            background-color: #fff;
            margin: 0 auto;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg, #1B7A75 0%, #156963 100%);
            padding: 25px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content-cell {
            padding: 40px 30px;
            text-align: center;
        }

        .alert-box {
            background: #e6f7f6;
            padding: 25px;
            border-right: 4px solid #1B7A75;
            border-radius: 10px;
        }

        .alert-box h2 {
            color: #1B7A75;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .alert-box p {
            color: #4a5568;
            font-size: 15px;
            margin: 0;
        }

        .footer {
            background: #2d3748;
            color: #a0aec0;
            text-align: center;
            padding: 25px 20px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="inner-body" style="direction: rtl; text-align: right;">
            <!-- Header -->
            <div class="header">
                <h1>تنفيذ تك</h1>
                <p>تم تفعيل حسابك بنجاح</p>
            </div>

            <!-- Content -->
            <div class="content-cell">
                <div class="alert-box">
                    <h2>مرحبًا {{ $user->name ?? 'عميلنا الكريم' }} 🎉</h2>
                    <h2>تم تفعيل حسابك بنجاح ✅</h2>
                    <p>مرحبًا بك في منصة <strong>تنفيذ تك</strong>!<br>
                        يمكنك الآن تسجيل الدخول والبدء في استخدام حسابك بكل سهولة.</p>
                </div>
            </div>
            <div class="divider"></div>

            @include('emails.partials.footer')
        </div>
    </div>
</body>

</html>