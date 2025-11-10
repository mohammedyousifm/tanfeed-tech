<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'تنفيذ تك')</title>

    <link rel="shortcut icon" href="{{ asset('logo/hlol-logo.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Main style --}}
    <link rel="stylesheet" href="{{ asset('main/main.css') }}">

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        body {
            position: relative;
            background-image: url('{{ asset('landing/images/saudi arabia legal office video.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* adjust opacity here */
            z-index: 0;
        }

        body * {
            position: relative;
            z-index: 1;
        }


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
            border-color: #1B7A75;
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


<body
    class="relative bg-cover bg-center bg-no-repeat before:content-[''] before:absolute before:inset-0 before:bg-black/50">
    <div class="relative z-10">
        <!-- your page content here -->



        <!-- Navigation -->
        <nav class="relative z-50 bg-white/5">
            <div class="container mx-auto px-6 lg:px-5">
                <div class="flex flex-col lg:flex-row items-center justify-between py-4 lg:py-2 gap-4">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">

                        <div class="flex flex-col">
                            <img src="{{ asset('logo/hlol-logo.png') }}" width="60" alt="logo" srcset="">
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @include('dashboard.partials.errors')


        @yield('contain')

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('landing/script.js') }}"></script>
</body>

</html>