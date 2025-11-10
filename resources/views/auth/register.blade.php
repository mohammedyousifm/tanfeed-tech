@extends('auth.app')
@section('title', 'التسجيل - تنفيذ تك')
@section('contain')

    <!-- Registration Form Section -->
    <section class="min-h-screen flex items-center mb-4">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-6">
                    <!-- Icon & Title -->
                    <div class="text-center mb-8">
                        <h1 class="f-16  font-bold text-black mb-2">إنشاء حساب جديد</h1>
                        <p class="f-13 md:text-base text-gray-600">سجل الآن وابدأ في إدارة شكاوى الديون بكفاءة</p>
                    </div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
                        class="space-y-6 text-sm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Company Name -->
                            <div>
                                <label for="company_name" class="form-label f-12">
                                    <i class="fas fa-building text-[#e2d392] ml-2"></i> اسم الشركة
                                </label>
                                <input type="text" id="company_name" name="company_name" class="form-input f-12"
                                    placeholder="أدخل اسم الشركة" value="{{ old('company_name') }}" required>
                                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                            </div>

                            <!-- Commercial Registration Number -->
                            <div>
                                <label for="commercial_number" class="form-label f-12">
                                    <i class="fas fa-file-contract text-[#e2d392] ml-2"></i> رقم السجل التجاري / التأسيس
                                </label>
                                <input type="text" id="commercial_number" name="commercial_number" class="form-input f-12"
                                    placeholder="أدخل رقم السجل التجاري" value="{{ old('commercial_number') }}" required>
                                <x-input-error :messages="$errors->get('commercial_number')" class="mt-2" />
                            </div>

                            <!-- Activity Type -->
                            <div>
                                <label for="activity_type" class="form-label f-12">
                                    <i class="fas fa-briefcase text-[#e2d392] ml-2"></i> نوع النشاط
                                </label>
                                <input type="text" id="activity_type" name="activity_type" class="form-input f-12"
                                    placeholder="أدخل نوع النشاط" value="{{ old('activity_type') }}" required>
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city" class="form-label f-12">
                                    <i class="fas fa-city text-[#e2d392] ml-2"></i> المدينة
                                </label>
                                <input type="text" id="city" name="city" class="form-input f-12" placeholder="أدخل المدينة"
                                    value="{{ old('city') }}" required>
                            </div>

                            <!-- District -->
                            <div>
                                <label for="district" class="form-label f-12">
                                    <i class="fas fa-map-marker-alt text-[#e2d392] ml-2"></i> الحي / المنطقة
                                </label>
                                <input type="text" id="district" name="district" class="form-input f-12"
                                    placeholder="أدخل الحي أو المنطقة" value="{{ old('district') }}" required>
                            </div>

                            <!-- Manager Name -->
                            <div>
                                <label for="manager_name" class="form-label f-12">
                                    <i class="fas fa-user-tie text-[#e2d392] ml-2"></i> اسم المدير (للشركات ) -اسم المالك
                                    ( للمؤسسات)
                                </label>
                                <input type="text" id="manager_name" name="manager_name" class="form-input f-12"
                                    placeholder="أدخل اسم" value="{{ old('manager_name') }}" required>
                            </div>

                            <!-- Phone 1 -->
                            <div>
                                <label for="phone_1" class="form-label f-12">
                                    رقم الجوال الأساسي <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center">
                                    <div class="relative w-full">
                                        <input type="text" id="phone_1" name="phone_1"
                                            class="block p-2.5 w-full text-sm text-gray-900 rounded-s-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                            placeholder="5xxxxxxxx" value="{{ old('phone_1') }}" required />
                                    </div>
                                    <button type="button"
                                        class="shrink-0 inline-flex items-center py-2.5 px-4 f-12 font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-e-lg">
                                        <img src="https://flagcdn.com/w40/sa.png" alt="SA"
                                            class="h-4 w-6 me-2 rounded-sm" />
                                        966+
                                    </button>
                                </div>
                                <p id="phone1-error" class="text-red-600 text-sm mt-1 hidden"></p>
                            </div>

                            <!-- Phone 2 -->
                            <div>
                                <label for="phone_2" class="form-label f-12"> رقم جوال إضافي </label>
                                <div class="flex items-center">
                                    <div class="relative w-full">
                                        <input type="text" id="phone_2" name="phone_2"
                                            class="block p-2.5 w-full f-12 text-gray-900 rounded-s-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                            placeholder="5xxxxxxxx" value="{{ old('phone_2') }}" />
                                    </div>
                                    <button type="button"
                                        class="shrink-0 f-12 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-e-lg">
                                        <img src="https://flagcdn.com/w40/sa.png" alt="SA"
                                            class="h-4 w-6 me-2 rounded-sm" />
                                        966+
                                    </button>
                                </div>
                                <p id="phone2-error" class="text-red-600 text-sm mt-1 hidden"></p>
                            </div>

                            <!-- Company Email -->
                            <div>
                                <label for="company_email" class="form-label f-12">
                                    <i class="fas fa-envelope text-[#e2d392] ml-2"></i> البريد الإلكتروني للشركة
                                </label>
                                <input type="email" id="company_email" name="company_email" class="form-input f-12"
                                    placeholder="company@domain.com" value="{{ old('company_email') }}" required>
                            </div>

                            <!-- Account Manager Name -->
                            <div>
                                <label for="account_manager_name" class="form-label f-12">
                                    <i class="fas fa-user text-[#e2d392] ml-2"></i> اسم مسؤول الحساب
                                </label>
                                <input type="text" id="account_manager_name" name="account_manager_name"
                                    class="form-input f-12" placeholder="أدخل اسم المسؤول"
                                    value="{{ old('account_manager_name') }}" required>
                            </div>

                            <!-- Upload Owner ID -->
                            <div>
                                <label class="form-label f-12">
                                    <i class="fas fa-id-card text-[#e2d392] ml-2"></i> هوية المدير ( للشركات ) - هوية المالك
                                    ( للمؤسسات)
                                </label>
                                <input type="file" id="owner_id_pdf" name="owner_id_pdf" accept="application/pdf"
                                    class="file-input w-full border rounded-lg text-gray-700 focus:ring-2 focus:ring-yellow-400"
                                    required>
                                @if ($errors->has('owner_id_pdf'))
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('owner_id_pdf') }}</p>
                                @elseif ($errors->any())
                                    <p class="text-yellow-600 text-xs mt-1">يرجى إعادة رفع الملف.</p>
                                @endif
                            </div>

                            <!-- Upload Commercial Record -->
                            <div>
                                <label class="form-label f-12">
                                    <i class="fas fa-file-pdf text-[#e2d392] ml-2"></i> السجل التجاري (PDF فقط)
                                </label>
                                <input type="file" id="commercial_record_pdf" name="commercial_record_pdf"
                                    accept="application/pdf"
                                    class="file-input w-full border rounded-lg text-gray-700 focus:ring-2 focus:ring-yellow-400"
                                    required>
                                @if ($errors->has('commercial_record_pdf'))
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('commercial_record_pdf') }}</p>
                                @elseif ($errors->any())
                                    <p class="text-yellow-600 text-xs mt-1">يرجى إعادة رفع الملف.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Account Email -->
                        <div>
                            <label for="accountEmail" class="form-label f-12">
                                <i class="fas fa-envelope text-[#e2d392] ml-2"></i> إيميل مسؤول الحساب
                            </label>
                            <input type="email" id="accountEmail" name="accountEmail" class="form-input f-12"
                                placeholder="example@domain.com" value="{{ old('accountEmail') }}" required>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="form-label f-12">
                                <i class="fas fa-lock text-[#e2d392] ml-2"></i> كلمة المرور
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-input f-12"
                                    placeholder="أدخل كلمة مرور قوية" required>
                                <button type="button" id="togglePassword"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-yellow-600 transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <!-- Password rules info -->
                            <p id="passwordHelp" class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-info-circle ml-1"></i>
                                يجب أن تحتوي على 8 أحرف على الأقل، حرف كبير، رقم، ورمز خاص.
                            </p>

                            <!-- Password strength feedback -->
                            <p id="passwordStrength" class="text-xs mt-1 font-semibold"></p>

                            <!-- Error message when trying to submit -->
                            <p id="passwordError" class="text-xs text-red-600 mt-1 hidden">
                                كلمة المرور لا تستوفي متطلبات الأمان!
                            </p>

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <script>
                            $(document).ready(function () {
                                // ✅ Toggle Password Visibility
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

                                // ✅ Password Strength Checker (Arabic feedback)
                                function checkPasswordStrength(password) {
                                    const hasUpper = /[A-Z]/.test(password);
                                    const hasNumber = /\d/.test(password);
                                    const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                                    const hasLength = password.length >= 8;

                                    let strength = 0;
                                    if (hasUpper) strength++;
                                    if (hasNumber) strength++;
                                    if (hasSpecial) strength++;
                                    if (hasLength) strength++;

                                    return { strength, hasUpper, hasNumber, hasSpecial, hasLength };
                                }

                                $('#password').on('input', function () {
                                    const password = $(this).val();
                                    const strengthText = $('#passwordStrength');
                                    const { strength } = checkPasswordStrength(password);

                                    if (password.length === 0) {
                                        strengthText.text('').removeClass();
                                        return;
                                    }

                                    // تقييم القوة
                                    switch (strength) {
                                        case 1:
                                            strengthText.text('كلمة المرور ضعيفة جدًا ⚠️')
                                                .removeClass().addClass('text-red-600');
                                            break;
                                        case 2:
                                            strengthText.text('كلمة المرور متوسطة 🟠')
                                                .removeClass().addClass('text-yellow-500');
                                            break;
                                        case 3:
                                            strengthText.text('كلمة المرور قوية ✅')
                                                .removeClass().addClass('text-green-600');
                                            break;
                                        case 4:
                                            strengthText.text('كلمة المرور قوية جدًا 💪')
                                                .removeClass().addClass('text-green-700');
                                            break;
                                    }
                                });

                                // ✅ Prevent form submit if password invalid
                                $('#registerForm').on('submit', function (e) {
                                    const password = $('#password').val();
                                    const { hasUpper, hasNumber, hasSpecial, hasLength } = checkPasswordStrength(password);

                                    if (!hasUpper || !hasNumber || !hasSpecial || !hasLength) {
                                        e.preventDefault(); // ⛔ stop submission
                                        $('#password').addClass('border-red-500');
                                        $('#passwordError').removeClass('hidden');
                                        $('html, body').animate({
                                            scrollTop: $('#password').offset().top - 100
                                        }, 400);
                                    } else {
                                        $('#password').removeClass('border-red-500');
                                        $('#passwordError').addClass('hidden');
                                    }
                                });
                            });
                        </script>



                        <!-- Terms -->
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="terms" name="terms"
                                class="mt-1 w-5 h-5 border-gray-300 rounded focus:ring-yellow-400" {{ old('terms') ? 'checked' : '' }} required>
                            <label for="terms" class="text-gray-600 text-sm">
                                أوافق على
                                <a href="{{ route('license') }}" class="font-semibold text-yellow-700 hover:underline">سياسة
                                    الخصوصية</a>
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

            </div>
        </div>
    </section>


@endsection