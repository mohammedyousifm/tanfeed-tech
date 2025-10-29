<!-- About Section -->
<section id="about" class="py-16 md:py-24 bg-white">
    <div class="container">
        <div class="flex flex-col md:flex-row items-center gap-12">

            <!-- Icon / Stats -->
            <div class="flex-1">
                <div class="bg-yellow rounded-lg p-10 md:p-1 shadow-strong">
                    <div class="flex-center">
                        <video autoplay muted loop playsinline id="heroVideoo">
                            <source src="{{ asset('landing/videos/videoplayback (1).mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 text-center md:text-right">
                <h2 class="text-2xl md:text-2xl font-bold text-black mb-4">
                    لماذا تختار <span class="text-[#e2d392]">تنفيذ تك</span>؟
                </h2>

                <p class="text-base md:text-lg text-gray-600 mb-3 leading-relaxed">
                    في <span class="text-[#e2d392] font-semibold">تنفيذ تك</span> نعمل على رقمنة قطاع القضايا والتحصيل،
                    حيث نربط بين التجار والمحامين والمحصلين عبر نظام موحد يسهّل إدارة الشكاوى ومتابعة سيرها من البداية
                    حتى الإغلاق.
                    هدفنا هو تمكين الجميع من الوصول إلى حلول قانونية ذكية وسريعة تحفظ الحقوق وتختصر الوقت والجهد.
                </p>

                <ul class="space-y-3 mb-3">
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-check-circle text-[#e2d392] text-xl"></i>
                        <span class="text-base md:text-lg">نظام موحد لرفع الشكاوى ومتابعتها إلكترونيًا</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-check-circle text-[#e2d392] text-xl"></i>
                        <span class="text-base md:text-lg">إشعارات فورية وتحديثات لحظية لكل حالة</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-check-circle text-[#e2d392] text-xl"></i>
                        <span class="text-base md:text-lg">إدارة متكاملة للمحامين والمحصلين داخل المنصة</span>
                    </li>
                </ul>

                <a href="#contact"
                    class="btn bg-gradient-to-r from-yellow-600 to-yellow-200 text-gray-900 text-base flex-center gap-2">
                    <i class="fas fa-envelope-open-text"></i> تواصل معنا
                </a>
            </div>
        </div>
    </div>
</section>