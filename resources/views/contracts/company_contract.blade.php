<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>عقد أنـاب خدمات قانونية</title>
    <style>
        body {
            font-family: "dejavusans", sans-serif;
            direction: rtl;
            text-align: justify;
            font-size: 14px;
            line-height: 1.9;
            margin: 50px 60px;
            color: #000;
        }

        /* ===== Header ===== */
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .contract-number {
            position: absolute;
            top: 30px;
            right: 60px;
            border: 1px solid #000;
            padding: 4px 12px;
            font-size: 12px;
            background: #f8f8f8;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin: 10px 0;
        }

        /* ===== Tables ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: middle;
            font-size: 13px;
        }

        th {
            background: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .highlight {
            background-color: #ffff99;
        }

        /* ===== Sections ===== */
        h3 {
            font-size: 15px;
            color: #000;
            margin-top: 25px;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        p {
            margin: 5px 0;
            text-align: justify;
        }


        footer {
            position: fixed;
            bottom: 20px;
            left: 60px;
            right: 60px;
            text-align: center;
            font-size: 12px;
            color: #444;
        }

        .bismillah {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="contract-number">
        رقم العقد: {{ $contract_number ?? '2025/01' }}
    </div>

    <header>
        <div class="bismillah">بسم الله الرحمن الرحيم</div>
        <h1>نموذج عقد أنـاب خدمات قانونية</h1>
    </header>


    <p>
        الحمد لله وحده، والصلاة والسلام على من لا نبي بعده، أما بعد:
        تم بعون الله وتوفيقه في يوم <span class="highlight">{{ $hijri_date ?? '...' }}</span>
        الموافق <span class="highlight">{{ $gregorian_date ?? '...' }}</span>
        الاتفاق والتعاقد بين كلٍ من:
    </p>

    <p>الاستاذ/{{ $user->name ?? '...' }} سعودي الجنسية ، يحمل هوية وطنية رقم
        ({{ $user->establishment_number ?? '...' }}) ويشار إليه في
        هاذا العقد بلطرف الأول
    </p>

    <table>
        <tr>
            <th>الطرف الثاني</th>
            <td>
                <strong>شركة حلول التقنيات القانونية</strong><br>
                المدينة: الرياض<br>
                البريد الإلكتروني: support@ltc.sa<br>
                الجوال: 0535392084
            </td>
        </tr>
    </table>

    <h3>التمهيد:</h3>
    <p>
        حيث إن الطرف الأول شركة تجارية مرخصة، ترغب في إسناد عدد من الخدمات القانونية إلى طرف متخصص...
        وقد تم الاتفاق والتراضي على ما يلي:
    </p>

    <h3>البند الأول: موضوع العقد</h3>
    <p>
        يلتزم الطرف الثاني بتقديم الخدمات القانونية الموضحة أعلاه، ويقر الطرف الأول بأن هذا العقد
        يشمل كافة البنود المتفق عليها بين الطرفين.
    </p>

    <h3>البند الثاني: مدة العقد</h3>
    <p>
        تبدأ مدة هذا العقد من تاريخ التوقيع عليه ولمدة <span class="highlight">{{ $duration ?? '...' }}</span>،
        قابلة للتجديد بموافقة الطرفين.
    </p>

    <h3>البند الثالث: أتعاب الطرف الثاني</h3>
    <p>
        الأتعاب المتفق عليها مقابل الخدمات هي <span class="highlight">{{ $amount ?? '...' }}</span> ريال سعودي،
        تُدفع بعد تقديم الخدمة المطلوبة حسب الاتفاق.
    </p>

    <footer>
        شركة حلول التقنيات القانونية | المملكة العربية السعودية - الرياض
    </footer>

</body>

</html>