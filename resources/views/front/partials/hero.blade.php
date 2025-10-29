<!-- Hero Section -->
<div class="relative h-screen p-4 overflow-hidden">
    <!-- Video Background -->
    <div class="video-container">
        <video autoplay muted loop playsinline id="heroVideo">
            <source src="{{ asset('landing/videos/videoplayback.mp4') }}" type="video/mp4">

        </video>
        <div class="video-overlay"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 bg-white/5">
        <div class="container mx-auto px-6 lg:px-5">
            <div class="flex flex-col lg:flex-row items-center justify-between py-4 lg:py-2 gap-4">
                <!-- Logo -->
                <div class="flex items-center gap-3">

                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-yellow-600 tracking-wide">تنفيذ تك</span>
                        <span class="text-xs text-gray-300 -mt-1">نظام إدارة القضايا والتحصيل</span>
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
                    <li><a href="#about"
                            class="nav-link text-white hover:text-yellow-600 transition-colors duration-300">من
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

    <!-- Hero Content -->
    <div class="relative z-40 flex items-center justify-center h-[calc(100vh-100px)]">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-7xl mx-auto text-right">
                <h1 style="line-height: 48px;"
                    class="text-4xl  md:text-5xl lg:text-4xl font-bold text-white mb-6 leading-tight animate-fadeInUp drop-shadow-2xl"
                    style="animation-delay: 0s;">
                    تنفيذ تك تساعدك في تحصيل فواتيرك المعدومة<br>
                    <span class="text-yellow-500">عبر تنفيذ تك</span>
                </h1>
                <p class="text-lg md:text-xl lg:text-1xl text-gray-200 mb-10 leading-relaxed animate-fadeInUp"
                    style="animation-delay: 0.2s; opacity: 0;">
                    نظام متكامل وذكي لإدارة القضايا القانونية وعمليات التحصيل بكفاءة عالية واحترافية
                </p>


                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
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
                    @endauth
                    <a href=""
                        class="px-6 py-2 bg-gradient-to-r from-yellow-600 to-yellow-200 text-gray-900 rounded-md font-semibold hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-600/40 transition-all duration-300">
                        خدماتنا القانونية
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Decorative Shapes -->
    <div class="absolute top-[15%] left-[5%] w-24 h-24 border-4 border-yellow-600/20 rounded-full animate-float z-30">
    </div>
    <div class="absolute bottom-[20%] right-[8%] w-20 h-20 border-4 border-yellow-600/20 rotate-45 z-30"
        style="animation: float 8s ease-in-out infinite reverse;"></div>
    <div class="absolute top-[35%] right-[10%] w-16 h-16 bg-yellow-600/5 rounded-xl animate-float z-30"
        style="animation-delay: 1s;"></div>
</div>