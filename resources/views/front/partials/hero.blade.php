<!-- Hero Section -->
<section id="home" class="py-5 md:py-16 bg-white">
    <div class="container">
        <div class="flex flex-col md:flex-row items-center gap-12">

            <!-- Text Content -->
            <div class="flex-1 text-center md:text-right">
                <h1 class="text-3xl md:text-5xl  font-bold text-black mb-4 leading-snug" style="line-height: 60px">
                    إدارة القضايا والتحصيل بسهولة عبر <span class="text-green">تنفيذ تك</span>
                </h1>
                <p class="text-base md:text-lg text-gray-600 mb-8">
                    منصة رقمية ذكية تربط بين التجار والمحامين والمحصلين لإدارة الشكاوى ومتابعة القضايا المالية
                    بكفاءة وشفافية، مع إشعارات فورية وتقارير تفصيلية في كل خطوة.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    @auth
                        <a href="{{ route(Auth::user()->role . '.dashboard') }}"
                            class="btn btn-green text-base flex-center gap-2">
                            لوحه
                            التحكم
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-green text-base flex-center gap-2">
                            ابدأ الآن
                        </a>
                    @endauth
                    <a href="#services" class="btn btn-yellow text-base flex-center gap-2">
                        تعرف على خدماتنا
                    </a>
                </div>
            </div>

            <!-- Image / Icon -->
            <div class="flex-1">
                <div class="bg-green rounded-lg p-8 md:p-8 shadow-strong flex-center">
                    <img class="rounded-md" src="{{ asset('landing/logo/font-1.png') }}" alt="" srcset="">
                </div>
            </div>


        </div>
    </div>
</section>