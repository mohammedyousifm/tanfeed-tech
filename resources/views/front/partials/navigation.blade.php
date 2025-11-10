<nav class="relative z-50 bg-white/5">
    <div class="container mx-auto px-6 lg:px-5">
        <div class="flex flex-col lg:flex-row items-center justify-between py-4 lg:py-2 gap-4">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="flex flex-col">
                    <img src="{{ asset('logo/logo-black.png') }}" width="180" alt="" srcset="">
                </div>
            </div>

            <!-- Navigation Menu -->
            <ul class="flex flex-wrap items-center gap-6 lg:gap-10">
                <li><a href="#home"
                        class="nav-link text-white hover:text-yellow-600 transition-colors duration-300">الرئيسية</a>
                </li>
                <li><a href="#services"
                        class="nav-link text-white hover:text-yellow-600 transition-colors duration-300">الخدمات</a>
                </li>
                <li><a href="#about" class="nav-link text-white hover:text-yellow-600 transition-colors duration-300">من
                        نحن</a></li>
                <li><a href="#contact"
                        class="nav-link text-white hover:text-yellow-600 transition-colors duration-300">اتصل
                        بنا</a></li>
            </ul>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3" style="font-size: 13px">
                @auth
                    <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                        class="px-6 py-2 border border-yellow-600 text-yellow-600 rounded-md hover:bg-yellow-600 hover:text-gray-900 transition-all duration-300">
                        لوحه
                        التحكم
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 border border-yellow-600 text-yellow-600 rounded-md hover:bg-yellow-600 hover:text-gray-900 transition-all duration-300">
                        تسجيل الدخول
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-gradient-to-r from-yellow-600 to-yellow-200 text-gray-900 rounded-md font-semibold hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-600/40 transition-all duration-300">
                        ابدأ الآن
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>