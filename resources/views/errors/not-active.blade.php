@extends('dashboard.partials.app')
@section('title', 'حالة الحساب')

@section('Content')
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="max-w-lg w-full bg-white rounded-xl shadow-md p-4 text-center border border-gray-200">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-full bg-[#1B7A75]/10 flex items-center justify-center">
                    <i class="fas fa-user-clock text-[#1B7A75] text-3xl"></i>
                </div>
            </div>

            ```
            <h2 class="text-2xl font-bold text-gray-800 mb-3">
                حسابك قيد المراجعة
            </h2>

            <p class="text-gray-600 text-sm leading-relaxed mb-5">
                شكرًا لتسجيلك معنا. نقوم حاليًا بمراجعة بيانات حسابك للتأكد من مطابقتها لسياساتنا ومعاييرنا.
                سيتم تفعيل حسابك قريبًا بعد اكتمال عملية المراجعة.
            </p>

            <p class="text-gray-600 text-sm leading-relaxed mb-5">
                تم إرسال عقد إلى بريدك الإلكتروني. يرجى توقيع العقد وإرساله عبر الرابط المرفق.
                إذا كنت قد أرسلته بالفعل، فنحن نراجع بياناتك حاليًا وسيتم تفعيل حسابك قريبًا.
            </p>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm text-gray-700 mb-6">
                في حال واجهت أي مشكلة أو تأخر في تفعيل الحساب، لا تتردد في التواصل معنا عبر البريد الإلكتروني:
                <a href="mailto:support@tanfeedtech.com" class="text-[#1B7A75] font-medium hover:underline">
                    support@ltc.sa
                </a>
            </div>


        </div>

    </div>
@endsection