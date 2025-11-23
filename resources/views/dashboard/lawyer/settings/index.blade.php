@extends('dashboard.partials.app')
@section('title', 'إعدادات الملف الشخصي')

@section('Content')
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-[var(--radius-md)] p-6">
        <h2 class="f-14 text-[#CF9411] font-semibold mb-6 text-[var(--color-black)]">
            إعدادات الملف الشخصي للتاجر
        </h2>

        {{-- Profile Update Form --}}
        <form action="{{ route('lawyer.settings.profile.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Register Info Section -->
            <div class="border-b pb-4">
                <h3 class="text-lg f-13 font-semibold mb-4 text-[#CF9411]">معلومات التسجيل</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm mb-1">اسم</label>
                        <input type="text" name="name" value="{{ old('account_manager_name', $user->name ?? '') }}"
                            class="w-full border f-11 rounded-[var(--radius-sm)] p-2 focus:ring-2 focus:ring-[var(--color-green)]">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">إيميل</label>
                        <input type="email" name="email" value="{{ old('account_manager_email', $user->email ?? '') }}"
                            class="w-full border f-11 rounded-[var(--radius-sm)] p-2 focus:ring-2 focus:ring-[var(--color-green)]">
                    </div>
                </div>
            </div>


            <div class="pt-6 border-t">
                <button type="submit"
                    class="prevent-double bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 px-6 py-2 rounded-[var(--radius-md)] hover:bg-green-700 transition">
                    حفظ التعديلات
                </button>
            </div>
        </form>
    </div>
@endsection