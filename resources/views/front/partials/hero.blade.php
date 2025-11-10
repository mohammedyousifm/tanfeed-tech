<!-- Hero Section -->
<div class="relative h-screen p-4 overflow-hidden">
    <!-- Video Background -->
    <div class="video-container">
        <video autoplay muted loop playsinline id="heroVideo">
            <source src="{{ asset('landing/videos/small-video.mp4') }}" type="video/mp4" media="(max-width: 768px)">
            <source src="{{ asset('landing/videos/videoplayback.mp4') }}" type="video/mp4" media="(min-width: 769px)">
            Your browser does not support the video tag.
        </video>
        <div class="video-overlay"></div>
    </div>


    @include('front.partials.header', ['sticky' => $sticky ?? true])


    <!-- Hero Content -->
    <div class="relative z-40 flex items-center justify-center h-[calc(100vh-100px)]">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-7xl mx-auto text-right">
                <h1 style="line-height: 48px;"
                    class="text-2xl  md:text-3xl  font-bold text-white mb-6 leading-tight animate-fadeInUp drop-shadow-2xl"
                    style="animation-delay: 0s;">
                    تنفيذ تك تساعدك في تحصيل فواتيرك المعدومة<br>
                    <span class="text-yellow-500">عبر تنفيذ تك</span>
                </h1>
                <p class="f-15  text-gray-200 mb-10 leading-relaxed animate-fadeInUp"
                    style="animation-delay: 0.2s; opacity: 0;">
                    نظام متكامل وذكي لإدارة القضايا القانونية وعمليات التحصيل بكفاءة عالية واحترافية
                </p>


                <!-- Action Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                            class="px-6 py-2 f-14 border border-yellow-600 text-yellow-600 rounded-md hover:bg-yellow-600 hover:text-gray-900 transition-all duration-300">
                            لوحه
                            التحكم
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class=" px-6 py-2 f-14 bg-[#CF9411] text-gray-900 rounded-md font-semibold hover:-translate-y-1 hover:shadow-lg hover:shadow-yellow-600/40 transition-all duration-300">
                            انضم إلينا الآن
                        </a>
                    @endauth
                    <a href="#services"
                        class="px-6 py-2 f-14 border border-yellow-600  text-[#CF9411] rounded-md  transition-all duration-300">
                        خدماتنا القانونية
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>