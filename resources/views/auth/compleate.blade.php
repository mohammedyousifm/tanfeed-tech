@extends('auth.app')
@section('title', 'التسجيل - تنفيذ تك')
@section('contain')

    <!-- Registration Form Section -->
    <section class="py-12 md:py-16 min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-2xl mx-auto">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-strong p-6 md:p-10">
                    <!-- Icon & Title -->
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-green rounded-lg flex-center mx-auto mb-4">
                            <i class="fas fa-user-plus text-white text-3xl"></i>
                        </div>
                        <h1 class="text-2xl md:text-2xl font-bold text-black mb-2">إضافة شركة جديدة</h1>
                        <p class="text-sm md:text-base text-gray-600">الرجاء تعبئة البيانات أدناه بدقة</p>
                    </div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('company_profiles.store') }}"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="font-semibold text-gray-700">اسم الشركة</label>
                                <input type="text" name="company_name" class="input input-bordered w-full" required>
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">رقم السجل التجاري / التأسيس</label>
                                <input type="text" name="establishment_number" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">نوع النشاط</label>
                                <input type="text" name="business_type" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">المدينة</label>
                                <input type="text" name="city" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">الحي / المنطقة</label>
                                <input type="text" name="district" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">اسم المدير</label>
                                <input type="text" name="manager_name" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">رقم الهاتف 1</label>
                                <input type="text" name="phone_1" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">رقم الهاتف 2</label>
                                <input type="text" name="phone_2" class="input input-bordered w-full">
                            </div>

                            <div class="md:col-span-2">
                                <label class="font-semibold text-gray-700">البريد الإلكتروني للشركة</label>
                                <input type="email" name="company_email" class="input input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">تحميل هوية المالك (PDF)</label>
                                <input type="file" name="owner_id_pdf" accept="application/pdf"
                                    class="file-input file-input-bordered w-full">
                            </div>

                            <div>
                                <label class="font-semibold text-gray-700">تحميل السجل التجاري (PDF)</label>
                                <input type="file" name="commercial_record_pdf" accept="application/pdf"
                                    class="file-input file-input-bordered w-full">
                            </div>
                        </div>

                        <button type="submit" class="btn prevent-double btn-green w-full text-base py-3">
                            <i class="fas fa-check-circle ml-2"></i> حفظ البيانات
                        </button>
                    </form>
                </div>


            </div>
        </div>
    </section>



@endsection