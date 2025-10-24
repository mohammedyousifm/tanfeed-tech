@extends('auth.app')
@section('title', 'نسيت كلمة المرور - تنفيذ تك')
@section('contain')

    <!-- Forgot Password Form Section -->
    <section class="py-12 md:py-16 min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-md mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-6 md:p-10">
                    <!-- Icon & Title -->
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-green rounded-lg flex-center mx-auto mb-4">
                            <i class="fas fa-key text-white text-3xl"></i>
                        </div>
                        <h1 class="text-1xl md:text-2xl font-bold text-black mb-2">نسيت كلمة المرور؟</h1>

                    </div>

                    <!-- Session Status (Success Message) -->
                    <div id="successMessage" class="alert-success hidden">
                        <i class="fas fa-check-circle ml-2"></i>
                        تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني!
                    </div>

                    <!-- Error Message -->
                    <div id="errorMessage" class="alert-error hidden">
                        <i class="fas fa-exclamation-circle ml-2"></i>
                        <span id="errorText"></span>
                    </div>
                    <p class="text-sm text-gray-600">
                        لا مشكلة. فقط أدخل عنوان بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور الذي سيسمح
                        لك باختيار كلمة مرور جديدة.
                    </p>


                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf


                        <div>
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope text-green ml-2"></i>
                                البريد الإلكتروني
                            </label>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>


                        <div class="flex prevent-double items-center justify-start mt-3">
                            <x-primary-button>
                                {{ __('  إرسال رابط إعادة التعيين') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Back to Login -->
                    <div class="text-center pt-6 border-t border-gray-200 mt-6">
                        <p class="text-sm text-gray-600">
                            تذكرت كلمة المرور؟
                            <a href="login.html" class="text-green font-semibold hover:underline">العودة لتسجيل
                                الدخول</a>
                        </p>
                    </div>
                </div>

                <!-- Help Notice -->
                <div class="mt-6 bg-white rounded-lg p-4 shadow-soft">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-green text-xl mt-1"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-black mb-1">لم تستلم الرسالة؟</h3>
                            <p class="text-xs text-gray-600">
                                تحقق من مجلد الرسائل غير المرغوب فيها (Spam)، أو تواصل مع فريق الدعم إذا استمرت المشكلة.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection