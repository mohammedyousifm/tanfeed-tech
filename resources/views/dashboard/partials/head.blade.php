<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'تنفيذ تك')</title>

    <link rel="shortcut icon" href="{{ asset('logo/hlol-logo.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Main style --}}
    <link rel="stylesheet" href="{{ asset('main/main.css') }}">

    <link rel="stylesheet" href="{{ asset('landing/style.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/style.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/merchant/style.css') }}">

    <style>
        .rounded-sm {
            border-radius: var(--radius-sm);
        }

        .rounded-md {
            border-radius: var(--radius-md);
        }

        .rounded-lg {
            border-radius: var(--radius-lg);
        }

        .sidebar {
            transition: var(--transition);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        .sidebar.collapsed {
            transform: translateX(100%);
        }

        .sidebar-overlay {
            transition: var(--transition);
            opacity: 0;
            pointer-events: none;
        }

        .sidebar-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .nav-link {
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            font-size: 13px;
        }

        .nav-link:hover {
            background-color: rgba(29, 153, 66, 0.1);
            padding-right: 20px;
        }

        .nav-link.active {
            background-color: #1B7A75;
            color: var(--color-white) !important;
        }

        .nav-link.active i {
            color: var(--color-white) !important;
        }

        .header {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            backdrop-filter: blur(10px);
        }

        .stat-card {
            transition: var(--transition);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 1024px) {
            .sidebar.collapsed {
                transform: translateX(0);
            }

            .main-content.expanded {
                margin-right: 0;
            }
        }
    </style>
</head>