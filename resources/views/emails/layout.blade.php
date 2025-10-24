<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'تنفيذ تك' }}</title>

    <style>
        /* ==============================
           تنفيذ تك - Email Style System
        ============================== */
        :root {
            --green: #1d9942;
            --yellow: #e2d392;
            --gray: #f5f5f5;
            --black: #1e1e1e;
            --white: #ffffff;
            --radius: 10px;
        }

        body {
            font-family: "Cairo", sans-serif;
            background: linear-gradient(135deg, #f8fff9 0%, #eafbea 100%);
            color: var(--black);
            direction: rtl;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 0;
        }

        .email-container {
            background-color: var(--white);
            border-radius: var(--radius);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            max-width: 620px;
            margin: auto;
            padding: 40px 30px;
            border-top: 6px solid var(--green);
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            color: var(--green);
            margin-bottom: 6px;
            font-size: 28px;
            font-weight: 800;
        }

        .divider {
            height: 3px;
            width: 80px;
            background-color: var(--yellow);
            margin: 10px auto 25px;
            border-radius: 10px;
        }

        /* Content */
        .content {
            font-size: 16px;
            line-height: 1.9;
            color: var(--black);
            text-align: right;
            padding: 0 10px;
        }

        .content p {
            margin-bottom: 16px;
        }

        /* Button */
        .btn {
            display: inline-block;
            background-color: var(--green);
            color: var(--white) !important;
            padding: 12px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(29, 153, 66, 0.25);
        }

        .btn:hover {
            background-color: #168536;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(29, 153, 66, 0.35);
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 35px;
            font-size: 13px;
            color: #777;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer small {
            color: #aaa;
        }

        /* Responsive */
        @media screen and (max-width: 640px) {
            .email-container {
                width: 90%;
                padding: 25px 20px;
            }

            .content {
                font-size: 15px;
            }

            .btn {
                font-size: 15px;
                padding: 10px 24px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Header -->
            <div class="header">
                <h1>منصة تنفيذ تك</h1>
                <div class="divider"></div>
            </div>

            <!-- Content -->
            <div class="content">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>© {{ date('Y') }} منصة تنفيذ تك — جميع الحقوق محفوظة</p>
                <small>تم إرسال هذه الرسالة تلقائيًا من نظام تنفيذ تك. يُرجى عدم الرد عليها.</small>
            </div>
        </div>
    </div>
</body>

</html>