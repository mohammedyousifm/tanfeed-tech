<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'تنفيذ تك' }}</title>
    <style>
        /* ======== تنفيذ تك Email Styles ======== */
        :root {
            --green: #1d9942;
            --yellow: #e2d392;
            --gray: #f5f5f5;
            --black: #1e1e1e;
        }

        body {
            font-family: "Cairo", sans-serif;
            background-color: var(--gray);
            color: var(--black);
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 0;
            background-color: var(--gray);
        }

        .email-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            margin: auto;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            color: var(--green);
            margin-bottom: 10px;
        }

        .divider {
            height: 3px;
            width: 80px;
            background-color: var(--yellow);
            margin: 0 auto 25px;
        }

        .content {
            font-size: 16px;
            line-height: 1.8;
            color: var(--black);
        }

        .btn {
            display: inline-block;
            background-color: var(--green);
            color: #fff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 35px;
            font-size: 13px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="header">
                <h1>تنفيذ تك</h1>
                <div class="divider"></div>
            </div>

            <div class="content">
                @yield('content')
            </div>

            <div class="footer">
                <p>© {{ date('Y') }} تنفيذ تك — جميع الحقوق محفوظة</p>
            </div>
        </div>
    </div>
</body>

</html>