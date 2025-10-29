<!-- Footer -->
<footer class="bg-green py-12 text-white">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <!-- Company Info -->
            <div class="text-center md:text-right">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-4">
                    <div class="w-20 h-20 bg-yellow p-1 rounded-md flex-center">
                        <img src="{{ asset('landing/logo/tlogo.png') }}" width="90" alt="logo" srcset="">
                    </div>

                </div>
                <p class="text-sm md:text-base opacity-90">
                    في تنفيذ تك نعمل على رقمنة قطاع القضايا والتحصيل، حيث نربط بين التجار والمحامين والمحصلين عبر نظام
                    موحد يسهّل إدارة الشكاوى ومتابعة سيرها من البداية حتى الإغلاق.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="text-center">
                <h3 class="text-xl font-bold mb-4">روابط سريعة</h3>
                <ul class="space-y-2 text-sm md:text-base">
                    <li><a href="#home" class="transition hover:text-yellow">الرئيسية</a></li>
                    <li><a href="#services" class="transition hover:text-yellow">الخدمات</a></li>
                    <li><a href="#about" class="transition hover:text-yellow">من نحن</a></li>
                    <li><a href="#contact" class="transition hover:text-yellow">اتصل بنا</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="text-center md:text-right">
                <h3 class="text-xl font-bold mb-4">تواصل معنا</h3>
                <ul class="space-y-3 text-sm md:text-base">
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-envelope"></i>
                        <span>info@tanfeztech.com</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-phone"></i>
                        <span>+966 50 123 4567</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>الرياض، المملكة العربية السعودية</span>
                    </li>
                </ul>
                <div class="flex items-center justify-center md:justify-start gap-4 mt-6">
                    <a href="#" class="w-10 h-10 bg-yellow rounded-md flex-center transition hover:opacity-80">
                        <i class="fab fa-facebook-f text-green"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-yellow rounded-md flex-center transition hover:opacity-80">
                        <i class="fab fa-twitter text-green"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-yellow rounded-md flex-center transition hover:opacity-80">
                        <i class="fab fa-linkedin-in text-green"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-yellow rounded-md flex-center transition hover:opacity-80">
                        <i class="fab fa-instagram text-green"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="border-t border-white border-opacity-20 pt-6 text-center text-sm md:text-base">
            <p>&copy; 2025 تنفيذ تك. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('landing/script.js') }}"></script>