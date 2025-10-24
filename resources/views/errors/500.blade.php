@extends('auth.app')
@section('title', '500 - خطأ في الخادم')

@section('contain')
    <section class="min-h-screen flex-center flex-col text-center">
        <div class="container py-20">
            <div class="max-w-md mx-auto bg-gray-50 rounded-lg shadow-soft p-10">

                <div class="bg-yellow rounded-full w-20 h-20 flex-center mx-auto mb-6 shadow-strong">
                    <i class="fas fa-exclamation-triangle text-green text-4xl"></i>
                </div>

                <h1 class="text-4xl font-bold text-black mb-3">500</h1>
                <h2 class="text-2xl font-semibold text-green mb-4">حدث خطأ غير متوقع</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    نأسف لحدوث هذا الخطأ! يبدو أن هناك مشكلة في الخادم أو في عملية التنفيذ.
                    فريقنا يعمل على إصلاحها في أقرب وقت ممكن.
                    يمكنك المحاولة مرة أخرى لاحقًا أو العودة للصفحة الرئيسية.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url()->previous() }}" class="btn btn-yellow hover-up">
                        <i class="fas fa-rotate-left ml-2"></i> إعادة المحاولة
                    </a>
                    <a href="/" class="btn btn-green hover-up">
                        <i class="fas fa-home ml-2"></i> الصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection