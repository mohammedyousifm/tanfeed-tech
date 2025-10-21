<!-- Header -->
<header class="bg-white shadow-soft sticky top-0 z-50">
    <nav class="container">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('landing/logo/tlogo.png') }}" width="90" alt="logo" srcset="">
            </div>

            <!-- Desktop Navigation -->
            <ul class="hidden md:flex items-center gap-8 text-base font-semibold">
                <li><a href="#home" class="transition hover:text-green">الرئيسية</a></li>
                <li><a href="#services" class="transition hover:text-green">الخدمات</a></li>
                <li><a href="#about" class="transition hover:text-green">من نحن</a></li>
                <li><a href="#contact" class="transition hover:text-green">اتصل بنا</a></li>
            </ul>

            <!-- Desktop Buttons -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="btn btn-yellow text-sm">لوحه التحكم</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-yellow text-sm">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="btn btn-green text-sm">ابدأ الآن</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button id="menuToggle" class="md:hidden text-2xl text-green">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu md:hidden pb-4">
            <ul class="flex flex-col gap-4 text-base font-semibold">
                <li><a href="#home" class="block transition hover:text-green">الرئيسية</a></li>
                <li><a href="#services" class="block transition hover:text-green">الخدمات</a></li>
                <li><a href="#about" class="block transition hover:text-green">من نحن</a></li>
                <li><a href="#contact" class="block transition hover:text-green">اتصل بنا</a></li>
            </ul>
            <div class="flex flex-col gap-3 mt-4">
                @auth
                    <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="btn btn-yellow text-center text-sm">لوحه
                        التحكم</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-yellow text-center text-sm">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="btn btn-green text-center text-sm">ابدأ الآن</a>
                @endauth

            </div>
        </div>
    </nav>
</header>