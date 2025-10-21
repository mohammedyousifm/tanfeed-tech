@extends('auth.app')
@section('title', '419 - انتهت الجلسة')

@section('contain')
    <section class="min-h-screen flex-center flex-col text-center bg-white">
        <div class="container py-20">
            <div class="max-w-md mx-auto bg-gray-50 rounded-lg shadow-soft p-10">

                <div class="bg-yellow rounded-full w-20 h-20 flex-center mx-auto mb-6 shadow-strong">
                    <i class="fas fa-clock text-green text-4xl"></i>
                </div>

                <h1 class="text-4xl font-bold text-black mb-3">419</h1>
                <h2 class="text-2xl font-semibold text-green mb-4">انتهت الجلسة</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    لقد انتهت جلستك بسبب فترة خمول طويلة أو مشكلة في الاتصال.
                    يرجى تسجيل الدخول مرة أخرى لمتابعة استخدام النظام بأمان.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="btn btn-green hover-up">
                        <i class="fas fa-right-to-bracket ml-2"></i> تسجيل الدخول مجددًا
                    </a>
                    <a href="/" class="btn btn-yellow hover-up">
                        <i class="fas fa-home ml-2"></i> الصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection