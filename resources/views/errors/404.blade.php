@extends('auth.app')
@section('title', '404 - الصفحة غير موجودة')

@section('contain')
    <section class="min-h-screen flex-center flex-col text-center bg-white">
        <div class="container py-20">
            <div class="max-w-md mx-auto bg-gray-50 rounded-lg shadow-soft p-10">

                <div class="bg-green rounded-full w-20 h-20 flex-center mx-auto mb-6 shadow-strong">
                    <i class="fas fa-search text-white text-4xl"></i>
                </div>

                <h1 class="text-4xl font-bold text-black mb-3">404</h1>
                <h2 class="text-2xl font-semibold text-green mb-4">الصفحة غير موجودة</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    عذرًا، الصفحة التي تبحث عنها غير متوفرة أو تم نقلها.
                    تأكد من صحة الرابط أو ارجع إلى الصفحة الرئيسية لمتابعة تصفحك.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url()->previous() }}" class="btn btn-yellow hover-up">
                        <i class="fas fa-arrow-right ml-2"></i> العودة للخلف
                    </a>
                    <a href="/" class="btn btn-green hover-up">
                        <i class="fas fa-home ml-2"></i> الصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
