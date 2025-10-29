@extends('auth.app')
@section('title', 'التسجيل - تنفيذ تك')
@section('contain')

    <!-- Login Form Section -->
    <section class="py-4  min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-md mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-6">
                    <!-- Icon & Title -->
                    <div class="text-center mb-8">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-yellow-600 to-yellow-200 rounded-lg flex-center mx-auto mb-4">
                            <i class="fas fa-sign-in-alt text-white text-3xl"></i>
                        </div>
                        <h1 class="text-2xl  font-bold text-black mb-2">تسجيل الدخول</h1>
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
                            <input type="email" id="email" name="email" class="form-input" placeholder=" البريد الإلكتروني"
                                required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="form-label">
                                <i class="fas fa-lock text-[#e2d392] ml-2"></i>
                                كلمة المرور
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" class="form-input"
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
                            <a href="{{ route('password.request') }}" class="text-green font-semibold hover:underline">نسيت
                                كلمة المرور؟</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn prevent-double bg-gradient-to-r from-yellow-600 to-yellow-200 w-full text-base py-3">
                            <i class="fas fa-sign-in-alt ml-2"></i>
                            تسجيل الدخول
                        </button>

                        <!-- Register Link -->
                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                ليس لديك حساب؟
                                <a href="{{  route('register') }}" class="text-green font-semibold hover:underline">إنشاء
                                    حساب
                                    جديد</a>
                            </p>
                        </div>
                    </form>

                    <!-- Divider -->
                    {{-- <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">أو</span>
                        </div>
                    </div>


                    <div class="space-y-3">
                        <button
                            class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-200 rounded-md py-2 px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            <i class="fab fa-google text-red-500 text-lg"></i>
                            <span>الدخول باستخدام Google</span>
                        </button>
                        <button
                            class="w-full flex items-center justify-center gap-3 bg-white border-2 border-gray-200 rounded-md py-2 px-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            <i class="fab fa-microsoft text-blue-500 text-lg"></i>
                            <span>الدخول باستخدام Microsoft</span>
                        </button>
                    </div>
                </div> --}}

                <!-- Security Notice -->
                <div class="mt-6 bg-white rounded-lg p-4 shadow-soft text-center">
                    <i class="fas fa-shield-alt text-green text-2xl mb-2"></i>
                    <p class="text-sm text-gray-600">
                        جميع بياناتك محمية بتشفير عالي المستوى
                    </p>
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