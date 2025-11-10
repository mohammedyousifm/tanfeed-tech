@extends('front.partials.app')
@section('title', 'تحميل وثيقة العقد')

@section('Content')
    <section id="contract"
        class="relative bg-cover p-4 bg-center bg-no-repeat before:content-[''] before:absolute before:inset-0 before:bg-black/50">
        <div class="body-section">
            <div class="max-w-2xl contain bg-white/95 p-6 md:p-10 mx-auto rounded-2xl shadow-lg leading-relaxed">
                <h1 class="text-2xl font-bold text-center text-yellow-700 mb-8">
                    تحميل وثيقة العقد
                </h1>
                <form action="{{ route('contract.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8 max-w-xl mx-auto bg-white p-6 rounded-2xl shadow">
                    @csrf

                    <h2 class="text-lg font-bold text-gray-800 text-center mb-4">📑 رفع ملفات العقد والوكالة</h2>

                    {{-- العقد --}}
                    <div class="border border-gray-200 rounded-xl p-4 hover:border-yellow-400 transition">
                        <label for="contract_file" class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                            <span class="text-yellow-600 text-xl">📄</span>
                            <span>تحميل ملف <strong>العقد</strong> (PDF, DOCX, JPG)</span>
                        </label>
                        <input type="file" name="contract_file" id="contract_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 p-2">
                        <p class="text-xs text-gray-500 mt-2">الحد الأقصى للحجم: 5MB</p>
                    </div>

                    {{-- الوكالة --}}
                    <div class="border border-gray-200 rounded-xl p-4 hover:border-yellow-400 transition">
                        <label for="agency_file" class="flex items-center gap-2 text-gray-700 font-semibold mb-2">
                            <span class="text-yellow-600 text-xl">🏢</span>
                            <span>تحميل ملف <strong>الوكالة</strong> (PDF, DOCX, JPG)</span>
                        </label>
                        <input type="file" name="agency_file" id="agency_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-white focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 p-2">
                        <p class="text-xs text-gray-500 mt-2">الحد الأقصى للحجم: 5MB</p>
                    </div>

                    {{-- Submit --}}
                    <div class="text-center pt-2">
                        <button type="submit"
                            class="px-6 py-2 bg-[#1B7A75] text-white text-sm font-semibold rounded-lg hover:bg-[#16615C] transition-all duration-300 shadow-sm hover:shadow-md">
                            📤 تقديم الملفات
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection

<style>
    footer {
        display: none;
    }

    #contract {
        margin-top: 2rem;
        height: 100vh;
    }
</style>