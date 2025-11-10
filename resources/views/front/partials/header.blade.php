<!-- Header -->
<header class="{{ $sticky ? 'sticky top-0 z-50 bg-white/5' : 'top-0 z-50 bg-white/5 relative' }}">
    <nav class="container">
        <div class="flex items-center justify-between py-2">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('logo/hlol-logo.png') }}" width="60" alt="" srcset="">
            </div>

            <!-- Desktop Navigation -->
            <ul class="hidden md:flex items-center gap-8 text-base font-semibold">
                <li><a href="#home" class="transition f-14 text-white hover:text-green">الرئيسية</a></li>
                <li><a href="#services" class="transition f-14 text-white hover:text-green">الخدمات</a></li>
                <li><a href="#about" class="transition f-14 text-white hover:text-green">من نحن</a></li>
                <li><a href="#contact" class="transition f-14 text-white hover:text-green">اتصل بنا</a></li>
            </ul>

            <!-- Desktop Buttons -->
            <div class="hidden md:flex items-center gap-3">
                @auth
                    <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                        class="btn bg-gradient-to-r from-yellow-600 to-yellow-200 text-gray-900 text-sm">لوحه التحكم</a>
                @else
                    <a href="{{ route('register') }}" class="f-13 btn bg-[#CF9411] font-bold text-gray-900 text-sm">ابدأ
                        الآن</a>
                    <a href="{{ route('login') }}"
                        class="f-13 btn px-6 py-2 f-13 border border-yellow-600 text-yellow-600 rounded-md hover:bg-yellow-600 hover:text-gray-900 transition-all duration-300  ">تسجيل
                        الدخول</a>

                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button id="menuToggle" class="md:hidden text-2xl text-yellow-600 ">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu md:hidden pb-4">
            <ul class="flex flex-col gap-4 pt-5 text-base font-semibold">
                <li><a href="#home" class="block transition  text-white hover:text-green">الرئيسية</a></li>
                <li><a href="#services" class="block transition text-white hover:text-green">الخدمات</a></li>
                <li><a href="#about" class="block transition text-white hover:text-green">من نحن</a></li>
                <li><a href="#contact" class="block transition text-white hover:text-green">اتصل بنا</a></li>
            </ul>
            <div class="flex flex-col gap-3 mt-4">
                @auth
                    <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                        class="btn f-13 bg-[#1B7A75] hover:bg-[#16615C] text-white text-center text-sm">لوحه
                        التحكم</a>
                @else
                    <a href="{{ route('login') }}"
                        class="btn f-13 bg-[#1B7A75] hover:bg-[#16615C] text-white text-center text-sm">تسجيل الدخول</a>
                    <a href="{{ route('register') }}"
                        class="btn f-13 bg-gradient-to-r from-yellow-600 to-yellow-200 text-gray-900 text-center text-sm">ابدأ
                        الآن</a>
                @endauth

            </div>
        </div>
    </nav>
</header>