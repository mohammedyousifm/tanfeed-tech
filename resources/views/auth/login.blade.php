@extends('auth.app')
@section('title', 'تنفيذ تك - تسجيل الدخول')
@section('contain')

    <!-- Login Form Section -->
    <section class="min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-md mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-4">
                    <!-- Icon & Title -->
                    <div class="text-center mb-7">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-yellow-600 to-yellow-200 rounded-lg flex-center mx-auto mb-2">
                            <i class="fas fa-sign-in-alt text-white text-2xl"></i>
                        </div>
                        <h1 class="text-1xl  font-bold text-black mb-2">تسجيل الدخول</h1>
                        <p class="text-sm md:text-base text-gray-600">مرحباً بعودتك! قم بتسجيل الدخول لحسابك</p>
                    </div>

                    <!-- Login Form -->
                    <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <!-- Email -->
                        <div>
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope text-[#e2d392] ml-2"></i>
                                البريد الإلكتروني
                            </label>
                            <input type="email" id="email" name="email" class="form-input f-12"
                                placeholder="البريد الإلكتروني" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="form-label">
                                <i class="fas fa-lock text-[#e2d392] ml-2"></i>
                                كلمة المرور
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-input f-12"
                                    placeholder="أدخل كلمة المرور" required>
                                <button type="button" id="togglePassword"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-green transition">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="remember" name="remember"
                                    class="w-4 h-4 text-green border-gray-300 rounded focus:ring-green">
                                <label for="remember" class="text-gray-600">تذكرني</label>
                            </div>
                            <a href="{{ route('password.request') }}" class=" font-semibold hover:underline">نسيت
                                كلمة المرور؟</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn f-13 prevent-double bg-gradient-to-r from-yellow-600 to-yellow-200 w-full text-white py-3">
                            تسجيل الدخول
                        </button>

                        <!-- Register Link -->
                        <div class="text-center pt-2 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                ليس لديك حساب؟
                                <a href="{{  route('register') }}"
                                    class="text-[#1B7A75] font-semibold hover:underline">إنشاء
                                    حساب
                                    جديد</a>
                            </p>
                        </div>
                    </form>
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