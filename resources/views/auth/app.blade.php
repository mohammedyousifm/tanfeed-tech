<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'app')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        /* Form Styles */
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e5e5e5;
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
            background-color: var(--color-white);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-green);
            box-shadow: 0 0 0 3px rgba(29, 153, 66, 0.1);
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: var(--color-black);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="bg-white shadow-soft">
        <nav class="container">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="index.html" class="flex items-center gap-2">
                    <div class="rounded-md flex-center">
                        <img src="{{ asset('landing/logo/tlogo.png') }}" width="80" alt="logo" srcset="">
                    </div>
                </a>

                <!-- Back to Home -->
                <a href="/" class="text-base font-semibold transition hover:text-green flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>العودة للرئيسية</span>
                </a>
            </div>
        </nav>
    </header>

    @yield('contain')

    <!-- Footer -->
    <footer class="bg-green py-8 text-white mt-auto">
        <div class="container">
            <div class="text-center">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <div class="w-10 h-10 bg-yellow rounded-md flex-center">
                        <i class="fas fa-code text-green text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold">تنفيذ تك</span>
                </div>
                <p class="text-sm md:text-base opacity-90 mb-4">
                    منصتك القانونية الموثوقة لإدارة شكاوى الديون واسترداد الحقوق بكفاءة وأمان.
                </p>
                <p class="text-sm">&copy; 2025 تنفيذ تك. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('landing/script.js') }}"></script>
</body>

</html>