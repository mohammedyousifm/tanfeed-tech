@extends('auth.app')
@section('title', 'التسجيل - تنفيذ تك')
@section('contain')

    <!-- Registration Form Section -->
    <section class="py-4 min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-2xl mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-4">
                    <!-- Icon & Title -->
                    <div class="text-center mb-8">
                        <div
                            class="w-10 h-10 p-5 bg-gradient-to-r from-yellow-600 to-yellow-200 rounded-lg flex-center mx-auto mb-4">
                            <i class="fas fa-user-plus text-white text-1xl"></i>
                        </div>
                        <h1 class="text-2xl  font-bold text-black mb-2">إنشاء حساب جديد</h1>
                        <p class="text-sm md:text-base text-gray-600">سجل الآن وابدأ في إدارة شكاوى الديون بكفاءة</p>
                    </div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                        class="space-y-6 text-sm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Company Name -->
                            <div>
                                <label for="company_name" class="form-label">
                                    <i class="fas fa-building text-[#e2d392] ml-2"></i> اسم الشركة
                                </label>
                                <input type="text" id="company_name" name="company_name" class="form-input"
                                    placeholder="أدخل اسم الشركة" required>
                                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                            </div>

                            <!-- Commercial Registration Number -->
                            <div>
                                <label for="commercial_number" class="form-label">
                                    <i class="fas fa-file-contract text-[#e2d392] ml-2"></i> رقم السجل التجاري / التأسيس
                                </label>
                                <input type="text" id="commercial_number" name="commercial_number" class="form-input"
                                    placeholder="أدخل رقم السجل التجاري" required>
                                <x-input-error :messages="$errors->get('commercial_number')" class="mt-2" />
                            </div>

                            <!-- Activity Type -->
                            <div>
                                <label for="activity_type" class="form-label">
                                    <i class="fas fa-briefcase text-[#e2d392] ml-2"></i> نوع النشاط
                                </label>
                                <input type="text" id="activity_type" name="activity_type" class="form-input"
                                    placeholder="أدخل نوع النشاط" required>
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="form-label">
                                    <i class="fas fa-city text-[#e2d392] ml-2"></i> المدينة
                                </label>
                                <input type="text" id="city" name="city" class="form-input" placeholder="أدخل المدينة"
                                    required>
                            </div>

                            <!-- District -->
                            <div>
                                <label for="district" class="form-label">
                                    <i class="fas fa-map-marker-alt text-[#e2d392] ml-2"></i> الحي / المنطقة
                                </label>
                                <input type="text" id="district" name="district" class="form-input"
                                    placeholder="أدخل الحي أو المنطقة" required>
                            </div>

                            <!-- Manager Name -->
                            <div>
                                <label for="manager_name" class="form-label">
                                    <i class="fas fa-user-tie text-[#e2d392] ml-2"></i> اسم المدير
                                </label>
                                <input type="text" id="manager_name" name="manager_name" class="form-input"
                                    placeholder="أدخل اسم المدير" required>
                            </div>

                            <!-- Phone 1 -->
                            <div>
                                <label for="phone_1" class="form-label">
                                    <i class="fas fa-phone-alt text-[#e2d392] ml-2"></i> رقم الهاتف 1
                                </label>
                                <input type="tel" id="phone_1" name="phone_1" class="form-input" placeholder="05XXXXXXXX"
                                    pattern="^05\d{8}$" required>

                            </div>

                            <!-- Phone 2 -->
                            <div>
                                <label for="phone_2" class="form-label">
                                    <i class="fas fa-phone text-[#e2d392] ml-2"></i> رقم الهاتف 2
                                </label>
                                <input type="tel" id="phone_2" name="phone_2" class="form-input" placeholder="05XXXXXXXX"
                                    pattern="^05\d{8}$">
                            </div>

                            <!-- Company Email -->
                            <div>
                                <label for="company_email" class="form-label">
                                    <i class="fas fa-envelope text-[#e2d392] ml-2"></i> البريد الإلكتروني للشركة
                                </label>
                                <input type="email" id="company_email" name="company_email" class="form-input"
                                    placeholder="company@domain.com" required>
                            </div>

                            <!-- Account Manager Name -->
                            <div>
                                <label for="account_manager_name" class="form-label">
                                    <i class="fas fa-user text-[#e2d392] ml-2"></i> اسم مسؤول الحساب
                                </label>
                                <input type="text" id="account_manager_name" name="account_manager_name" class="form-input"
                                    placeholder="أدخل اسم المسؤول" required>
                            </div>

                            <!-- Upload Owner ID -->
                            <div>
                                <label class="form-label">
                                    <i class="fas fa-id-card text-[#e2d392] ml-2"></i> هوية المالك (PDF فقط)
                                </label>
                                <input type="file" id="owner_id_pdf" name="owner_id_pdf" accept="application/pdf"
                                    class="file-input w-full border rounded-lg text-gray-700 focus:ring-2 focus:ring-yellow-400"
                                    required>
                                <p id="ownerError" class="text-red-500 text-xs mt-1 hidden">يجب رفع ملف PDF فقط.</p>
                            </div>

                            <!-- Upload Commercial Record -->
                            <div>
                                <label class="form-label">
                                    <i class="fas fa-file-pdf text-[#e2d392] ml-2"></i> السجل التجاري (PDF فقط)
                                </label>
                                <input type="file" id="commercial_record_pdf" name="commercial_record_pdf"
                                    accept="application/pdf"
                                    class="file-input w-full border rounded-lg text-gray-700 focus:ring-2 focus:ring-yellow-400"
                                    required>
                                <p id="recordError" class="text-red-500 text-xs mt-1 hidden">يجب رفع ملف PDF فقط.</p>
                            </div>
                        </div>

                        <!-- Account Email -->
                        <div>
                            <label for="accountEmail" class="form-label">
                                <i class="fas fa-envelope text-[#e2d392] ml-2"></i> إيميل مسؤول الحساب
                            </label>
                            <input type="email" id="accountEmail" name="accountEmail" class="form-input"
                                placeholder="example@domain.com" required>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="form-label">
                                <i class="fas fa-lock text-[#e2d392] ml-2"></i> كلمة المرور
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-input"
                                    placeholder="أدخل كلمة مرور قوية" required>
                                <button type="button" id="togglePassword"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-yellow-600 transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <p id="passwordHelp" class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle ml-1"></i> يجب أن تحتوي على 8 أحرف على الأقل، حرف كبير، رقم،
                                ورمز خاص.
                            </p>
                            <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">كلمة المرور ضعيفة جدًا.</p>
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="terms" name="terms"
                                class="mt-1 w-5 h-5 border-gray-300 rounded focus:ring-yellow-400" required>
                            <label for="terms" class="text-gray-600 text-sm">
                                أوافق على <a href="#" class="font-semibold text-yellow-700 hover:underline">الشروط
                                    والأحكام</a> و
                                <a href="#" class="font-semibold text-yellow-700 hover:underline">سياسة الخصوصية</a>
                            </label>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="btn prevent-double bg-gradient-to-r from-yellow-600 to-yellow-200 text-white w-full py-3 font-semibold rounded-lg shadow-md hover:shadow-lg transition">
                            <i class="fas fa-check-circle ml-2"></i> إنشاء الحساب
                        </button>

                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                لديك حساب بالفعل؟
                                <a href="{{ route('login') }}" class="font-semibold text-yellow-700 hover:underline">تسجيل
                                    الدخول</a>
                            </p>
                        </div>
                    </form>


                </div>

                <!-- Features List -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4 shadow-soft text-center">
                        <i class="fas fa-shield-alt text-green text-2xl mb-2"></i>
                        <p class="text-sm font-semibold">أمان وخصوصية تامة</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-soft text-center">
                        <i class="fas fa-bolt text-green text-2xl mb-2"></i>
                        <p class="text-sm font-semibold">تفعيل فوري للحساب</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-soft text-center">
                        <i class="fas fa-headset text-green text-2xl mb-2"></i>
                        <p class="text-sm font-semibold">دعم فني على مدار الساعة</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            // Toggle Password Visibility
            $('#togglePassword').click(function () {
                const passwordField = $('#password');
                const icon = $(this).find('i');

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>

@endsection