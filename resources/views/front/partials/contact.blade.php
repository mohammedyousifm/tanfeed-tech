<style>
    .btn-primary {
        background-color: var(--color-green);
        color: var(--color-white);
        transition: var(--transition);
    }

    .btn-primary:hover {
        background-color: #166b32;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(29, 153, 66, 0.3);
    }

    .input-field {
        border: 2px solid #e5e7eb;
        border-radius: var(--radius-sm);
        transition: var(--transition);
    }

    .input-field:focus {
        outline: none;
        border-color: var(--color-green);
        box-shadow: 0 0 0 3px rgba(29, 153, 66, 0.1);
    }

    .contact-card {
        background: var(--color-white);
        border-radius: var(--radius-md);
        transition: var(--transition);
        border: 1px solid #e5e7eb;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .icon-wrapper {
        background: linear-gradient(135deg, var(--color-green), #25b855);
        border-radius: var(--radius-sm);
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeInUp 0.8s ease-out;
    }
</style>

<section id="contact" class="py-16 px-4 md:py-24">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12 animate-fade-in">
            <h2 class="text-3xl md:text-3xl font-bold mb-4" style="color: var(--color-black)">
                تواصل معنا
            </h2>
            <p class=" text-gray-600 max-w-3xl mx-auto leading-relaxed">
                منصة رقمية ذكية تربط بين التجار والمحامين والمحصلين لإدارة الشكاوى ومتابعة القضايا المالية بكفاءة
                وشفافية، مع إشعارات فورية وتقارير تفصيلية في كل خطوة
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-start">
            <!-- Contact Info Cards -->
            <div class="space-y-6">
                <!-- Phone Card -->
                <div class="contact-card p-6">
                    <div class="flex items-start gap-4">
                        <div class="icon-wrapper">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm mb-2" style="color: var(--color-black)">الهاتف</h3>
                            <p class="text-gray-600 mb-1">+966 XX XXX XXXX</p>
                            <p class="text-gray-600">متاح من السبت إلى الخميس، 9 صباحاً - 6 مساءً</p>
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="contact-card p-6">
                    <div class="flex items-start gap-4">
                        <div class="icon-wrapper">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm mb-2" style="color: var(--color-black)">البريد الإلكتروني</h3>
                            <p class="text-gray-600 mb-1">info@platform.com</p>
                            <p class="text-gray-600">نرد عادة خلال 24 ساعة</p>
                        </div>
                    </div>
                </div>

                <!-- Location Card -->
                <div class="contact-card p-6">
                    <div class="flex items-start gap-4">
                        <div class="icon-wrapper">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm mb-2" style="color: var(--color-black)">العنوان</h3>
                            <p class="text-gray-600 mb-1">الرياض، المملكة العربية السعودية</p>
                            <p class="text-gray-600">حي الملك فهد، طريق الملك عبدالعزيز</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-card p-8">
                <h3 class="text-1xl font-bold mb-6" style="color: var(--color-black)">أرسل لنا رسالة</h3>
                <form id="contactForm" class="space-y-5">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">الاسم الكامل</label>
                        <input type="text" class="input-field w-full px-4 py-3" placeholder="أدخل اسمك الكامل" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">البريد الإلكتروني</label>
                        <input type="email" class="input-field w-full px-4 py-3" placeholder="example@email.com"
                            required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">رقم الهاتف</label>
                        <input type="tel" class="input-field w-full px-4 py-3" placeholder="+966 XX XXX XXXX" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">الموضوع</label>
                        <select class="input-field w-full px-4 py-3" required>
                            <option value="">اختر الموضوع</option>
                            <option value="complaint">شكوى جديدة</option>
                            <option value="case">استفسار عن قضية</option>
                            <option value="support">دعم فني</option>
                            <option value="other">أخرى</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">الرسالة</label>
                        <textarea class="input-field w-full px-4 py-3 resize-none" rows="5"
                            placeholder="اكتب رسالتك هنا..." required></textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full py-2 rounded-lg font-bold text-sm">
                        إرسال الرسالة
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        e.preventDefault();
        alert('شكراً لتواصلك معنا! سنرد عليك في أقرب وقت ممكن.');
        this.reset();
    });
</script>