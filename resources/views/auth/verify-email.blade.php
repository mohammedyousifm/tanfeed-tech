@extends('auth.app')
@section('title', 'التحقق من البريد الإلكتروني - تنفيذ تك')
@section('contain')

    <section class="py-12 md:py-16 min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-md mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-6 md:p-10">
                    <!-- Icon & Title -->
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-green rounded-lg flex-center mx-auto mb-4">
                            <i class="fas fa-sign-in-alt text-white text-3xl"></i>
                        </div>
                        <h1 class="text-2xl md:text-2xl font-bold text-black mb-2">التحقق من البريد الإلكتروني</h1>

                    </div>

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('شكرًا لتسجيلك! قبل البدء، هل يمكنك التحقق من بريدك الإلكتروني بالضغط على الرابط الذي أرسلناه إليك؟ إذا لم تستلم البريد الإلكتروني، فسنرسل إليك رسالة أخرى بكل سرور.') }}
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('لقد تم إرسال رابط تحقق جديد إلى عنوان البريد الإلكتروني الذي قدمته أثناء التسجيل.') }}
                        </div>
                    @endif

                    <div class="mt-4 flex items-center justify-between">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <x-primary-button>
                                    {{ __('إعادة إرسال بريد إلكتروني للتحقق') }}
                                </x-primary-button>
                            </div>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('تسجيل الخروج') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    </section>

@endsection