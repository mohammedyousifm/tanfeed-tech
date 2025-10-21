@extends('auth.app')
@section('title', 'التسجيل - تنفيذ تك')
@section('contain')

    <!-- Registration Form Section -->
    <section class="py-12 md:py-16 min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-2xl mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-6 md:p-10">
                    <!-- Icon & Title -->
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-green rounded-lg flex-center mx-auto mb-4">
                            <i class="fas fa-user-plus text-white text-3xl"></i>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-black mb-2">إنشاء حساب جديد</h1>
                        <p class="text-sm md:text-base text-gray-600">سجل الآن وابدأ في إدارة شكاوى الديون بكفاءة</p>
                    </div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf
                        <!-- Account Manager Name -->
                        <div>
                            <label for="accountName" class="form-label">
                                <i class="fas fa-user text-green ml-2"></i>
                                اسم مسؤول الحساب
                            </label>
                            <input type="text" id="accountName" name="name" class="form-input"
                                placeholder="أدخل الاسم الكامل" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Account Manager Email -->
                        <div>
                            <label for="accountEmail" class="form-label">
                                <i class="fas fa-envelope text-green ml-2"></i>
                                إيميل مسؤول الحساب
                            </label>
                            <input type="email" id="accountEmail" name="email" class="form-input"
                                placeholder="example@domain.com" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="form-label">
                                <i class="fas fa-lock text-green ml-2"></i>
                                كلمة المرور
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-input"
                                    placeholder="أدخل كلمة مرور قوية" required>
                                <button type="button" id="togglePassword"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-green transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-info-circle ml-1"></i>
                                يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل
                            </p>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="terms" name="terms"
                                class="mt-1 w-5 h-5 text-green border-gray-300 rounded focus:ring-green" required>
                            <label for="terms" class="text-sm md:text-base text-gray-600">
                                أوافق على <a href="#" class="text-green font-semibold hover:underline">الشروط
                                    والأحكام</a> و <a href="#" class="text-green font-semibold hover:underline">سياسة
                                    الخصوصية</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-green w-full text-base py-3">
                            <i class="fas fa-check-circle ml-2"></i>
                            إنشاء الحساب
                        </button>

                        <!-- Login Link -->
                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                لديك حساب بالفعل؟
                                <a href="login.html" class="text-green font-semibold hover:underline">تسجيل الدخول</a>
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
