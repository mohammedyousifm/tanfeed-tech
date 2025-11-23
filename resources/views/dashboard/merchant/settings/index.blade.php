@extends('dashboard.partials.app')
@section('title', 'إعدادات الملف الشخصي')

@section('Content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-[var(--radius-md)] p-6">
        <h2 class="text-2xl font-semibold mb-6 text-[var(--color-black)]">
            إعدادات الملف الشخصي للتاجر
        </h2>

        {{-- Profile Update Form --}}
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Register Info Section -->
            <div class="border-b pb-4">
                <h3 class="text-lg font-semibold mb-4 text-[#1B7A75]">معلومات التسجيل</h3>

                <div class=" grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm mb-1">اسم مسؤول الحساب</label>
                        <input type="text" name="account_manager_name" readonly
                            value="{{ old('account_manager_name', $user->name ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2 focus:ring-2 focus:ring-[var(--color-green)]">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">إيميل مسؤول الحساب</label>
                        <input type="email" name="account_manager_email" readonly
                            value="{{ old('account_manager_email', $user->email ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2 focus:ring-2 focus:ring-[var(--color-green)]">
                    </div>
                </div>
            </div>

            <!-- Profile Info Section -->
            <div>
                <h3 class="text-lg font-semibold mb-4 text-[#1B7A75]">معلومات الملف الشخصي</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-sm mb-1">اسم الشركة</label>
                        <input type="text" name="company_name"
                            value="{{ old('company_name', $Companyinfo->company_name ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">رقم السجل التجاري / التأسيس</label>
                        <input type="text" name="commercial_number" readonly
                            value="{{ old('commercial_number', $Companyinfo->establishment_number ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">نوع النشاط</label>
                        <input type="text" name="business_type" readonly
                            value="{{ old('business_type', $Companyinfo->business_type ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">المدينة</label>
                        <input type="text" name="city" readonly value="{{ old('city', $Companyinfo->city ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">الحي / المنطقة</label>
                        <input type="text" name="district" readonly
                            value="{{ old('district', $Companyinfo->district ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">اسم المدير</label>
                        <input type="text" name="manager_name" readonly
                            value="{{ old('manager_name', $Companyinfo->manager_name ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">رقم الهاتف 1</label>
                        <input type="tel" name="phone_1" readonly value="{{ old('phone_1', $Companyinfo->phone_1 ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">رقم الهاتف 2</label>
                        <input type="tel" name="phone_2" readonly value="{{ old('phone_2', $Companyinfo->phone_2 ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block font-medium text-sm mb-1">البريد الإلكتروني للشركة</label>
                        <input type="email" name="company_email"
                            value="{{ old('company_email', $Companyinfo->company_email ?? '') }}"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">هوية المالك (PDF)</label>
                        <input type="file" name="owner_id" readonly accept="application/pdf"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                        @if(!empty($Companyinfo->owner_id_pdf))
                            <a href="{{ asset('storage/' . $Companyinfo->owner_id) }}" target="_blank"
                                class="text-[var(--color-green)] text-sm">عرض الملف الحالي</a>
                        @endif
                    </div>

                    <div>
                        <label class="block font-medium text-sm mb-1">السجل التجاري</label>
                        <input type="file" readonly name="commercial_doc" accept="application/pdf"
                            class="w-full border rounded-[var(--radius-sm)] p-2">
                        @if(!empty($Companyinfo->commercial_record_pdf))
                            <a href="{{ asset('storage/' . $Companyinfo->commercial_doc) }}" target="_blank"
                                class="text-[var(--color-green)] text-sm">عرض الملف الحالي</a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- <div class="pt-6 border-t">
                <button type="submit"
                    class=" prevent-double bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 px-6 py-2 rounded-[var(--radius-md)] hover:bg-green-700 transition">
                    حفظ التعديلات
                </button>
            </div> --}}
        </form>
    </div>
@endsection
