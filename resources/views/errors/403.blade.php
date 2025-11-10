@extends('auth.app')
@section('title', '403 - غير مصرح بالدخول')

@section('contain')
    <section class="min-h-screen flex-center flex-col  text-center">
        <div class="container">
            <div class="max-w-md mx-auto bg-gray-50 rounded-lg shadow-soft p-10">

                <div class="bg-green rounded-full w-20 h-20 flex-center mx-auto mb-6 shadow-strong">
                    <i class="fas fa-ban text-white text-4xl"></i>
                </div>

                <h1 class="text-4xl font-bold text-black mb-3">403</h1>
                <h2 class="text-2xl font-semibold text-green mb-4">غير مصرح لك بالدخول</h2>
                <p class="text-gray-600 mb-6">
                    عذرًا، ليس لديك صلاحية للوصول إلى هذه الصفحة.
                    إذا كنت تعتقد أن هذا خطأ، يرجى التواصل مع الدعم الفني أو العودة إلى الصفحة الرئيسية.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center pb-16  p-5">
                    <a href="{{ url()->previous() }}" class="btn f-13 btn-yellow hover-up">
                        <i class="fas fa-arrow-right ml-2"></i> العودة للخلف
                    </a>
                    <a href="/" class="btn f-13 btn-green hover-up">
                        <i class="fas fa-home ml-2"></i> الصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection