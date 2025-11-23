@extends('dashboard.partials.app')
@section('title', 'إنشاء طلب جديد')

@section('Content')
    <form id="complaintsubmiteForm" action="{{ route('merchant.complaints.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <!-- معلومات العميل الأساسية -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-user"></i>
                معلومات العميل الأساسية
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Client name --}}
                <div>
                    <label for="client_name" class="form-label">
                        اسم العميل <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}"
                        class="form-input f-13 w-full px-3 py-2 rounded-md" placeholder="أدخل اسم العميل" required>
                </div>

                <!-- Client national id -->
                <div>
                    <label for="client_national_id" class="form-label">
                        رقم الهوية <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="client_national_id" name="client_national_id"
                        value="{{ old('client_national_id') }}" class="form-input f-13 w-full px-3 py-2 rounded-md"
                        placeholder="أدخل رقم الهوية" required>
                    <p id="national-id-error" class="text-red-600 f-11 text-sm mt-1 hidden"></p>
                </div>

                <!-- Phone number 1 -->
                <div>
                    <label for="phone_number1" class="form-label">
                        رقم الجوال الأساسي <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center">
                        <div class="relative w-full">
                            <input type="text" id="phone_number1" name="phone_number1" value="{{ old('phone_number1') }}"
                                class="block p-2 w-full f-13   text-gray-900 rounded-s-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                placeholder="5xxxxxxxx" required />
                        </div>
                        <button type="button"
                            class="shrink-0 inline-flex items-center py-2.5 px-2 f-12 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-e-lg">
                            <img src="https://flagcdn.com/w40/sa.png" alt="SA" class="h-4 w-6 me-2 rounded-sm" />
                            966+
                        </button>
                    </div>
                    <p id="phone1-error" class="text-red-600 f-11 text-sm mt-1 hidden"></p>
                </div>

                <!-- Phone number 2 -->
                <div>
                    <label for="phone_number2" class="form-label">
                        رقم جوال إضافي
                    </label>
                    <div class="flex items-center">
                        <div class="relative w-full">
                            <input type="text" id="phone_number2" name="phone_number2" value="{{ old('phone_number2') }}"
                                class="block p-2 w-full f-13 text-gray-900 rounded-s-lg border border-gray-300 focus:ring-green-500 focus:border-green-500"
                                placeholder="5xxxxxxxx" />
                        </div>
                        <button type="button"
                            class="shrink-0 inline-flex items-center py-2.5 px-2 f-12 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-e-lg">
                            <img src="https://flagcdn.com/w40/sa.png" alt="SA" class="h-4 w-6 me-2 rounded-sm" />
                            966+
                        </button>
                    </div>
                    <p id="phone2-error" class="text-red-600 f-11  text-sm mt-1 hidden"></p>
                </div>

                {{-- City --}}
                <div>
                    <label for="client_city" class="form-label">
                        المدينة <span class="text-red-500">*</span>
                    </label>
                    <select id="client_city" name="client_city"
                        class="form-input f-13 w-full px-3 py-2 rounded-md border border-gray-300 focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] outline-none text-gray-800"
                        required>
                        <option value="">اختر المدينة</option>

                        <option value="الرياض">الرياض</option>
                        <option value="جدة">جدة</option>
                        <option value="مكة المكرمة">مكة المكرمة</option>
                        <option value="المدينة المنورة">المدينة المنورة</option>
                        <option value="الدمام">الدمام</option>
                        <option value="الخبر">الخبر</option>
                        <option value="الظهران">الظهران</option>
                        <option value="الأحساء">الأحساء</option>
                        <option value="القطيف">القطيف</option>
                        <option value="الطائف">الطائف</option>
                        <option value="خميس مشيط">خميس مشيط</option>
                        <option value="أبها">أبها</option>
                        <option value="نجران">نجران</option>
                        <option value="جازان">جازان</option>
                        <option value="الباحة">الباحة</option>
                        <option value="تبوك">تبوك</option>
                        <option value="حائل">حائل</option>
                        <option value="عرعر">عرعر</option>
                        <option value="سكاكا">سكاكا</option>
                        <option value="القريات">القريات</option>
                        <option value="ينبع">ينبع</option>
                        <option value="رابغ">رابغ</option>
                        <option value="الجبيل">الجبيل</option>
                        <option value="رأس تنورة">رأس تنورة</option>
                        <option value="بيشة">بيشة</option>
                        <option value="القنفذة">القنفذة</option>
                        <option value="الليث">الليث</option>
                        <option value="محايل عسير">محايل عسير</option>
                        <option value="بلجرشي">بلجرشي</option>
                        <option value="المجمعة">المجمعة</option>
                        <option value="الزلفي">الزلفي</option>
                        <option value="الخرج">الخرج</option>
                        <option value="الدلم">الدلم</option>
                        <option value="الدوادمي">الدوادمي</option>
                        <option value="وادي الدواسر">وادي الدواسر</option>
                        <option value="شقراء">شقراء</option>
                        <option value="عفيف">عفيف</option>
                        <option value="السليل">السليل</option>
                        <option value="رنية">رنية</option>
                        <option value="بيشة">بيشة</option>
                        <option value="البكيرية">البكيرية</option>
                        <option value="الرس">الرس</option>
                        <option value="عنيزة">عنيزة</option>
                        <option value="بريدة">بريدة</option>
                        <option value="المذنب">المذنب</option>
                        <option value="البدائع">البدائع</option>
                        <option value="رياض الخبراء">رياض الخبراء</option>
                        <option value="الأسياح">الأسياح</option>
                        <option value="الشملي">الشملي</option>
                        <option value="تيماء">تيماء</option>
                        <option value="العلا">العلا</option>
                        <option value="خيبر">خيبر</option>
                        <option value="بدر">بدر</option>
                        <option value="الوجه">الوجه</option>
                        <option value="ضباء">ضباء</option>
                        <option value="البدع">البدع</option>
                        <option value="حقل">حقل</option>
                        <option value="أملج">أملج</option>
                    </select>
                </div>

                <!-- Activity type -->
                <div>
                    <label for="activity_type" class="form-label">
                        نوع النشاط <span class="text-red-500">*</span>
                    </label>
                    <select id="activity_type" name="activity_type" class="form-input f-13 w-full px-3 py-2 rounded-md"
                        required>
                        <option value="">اختر نوع النشاط</option>
                        <option value="فرد" {{ old('activity_type') == 'فرد' ? 'selected' : '' }}>فرد</option>
                        <option value="شركة" {{ old('activity_type') == 'شركة' ? 'selected' : '' }}>شركة</option>
                        <option value="مؤسسة" {{ old('activity_type') == 'مؤسسة' ? 'selected' : '' }}>مؤسسة</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- المعلومات التجارية -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-briefcase"></i>
                المعلومات التجارية
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="commercial_name" class="form-label">
                        الاسم التجاري
                    </label>
                    <input type="text" id="commercial_name" name="commercial_name" required
                        class="form-input f-13 w-full px-3 py-2 rounded-md" placeholder="أدخل الاسم التجاري">
                </div>

                <div>
                    <label for="commercial_record_number" class="form-label">
                        رقم السجل التجاري
                    </label>
                    <input type="text" id="commercial_record_number" name="commercial_record_number" required
                        class="form-input f-13 w-full px-3 py-2 rounded-md" placeholder="أدخل رقم السجل التجاري">
                </div>
            </div>
        </div>

        <!-- معلومات المدير (مخفية افتراضياً) -->
        <div class="form-section hidden" id="managerSection">
            <h3 class="section-title">
                <i class="fas fa-user-tie"></i>
                معلومات المدير
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="manager_name" class="form-label">
                        اسم المدير
                    </label>
                    <input type="text" id="manager_name" name="manager_name"
                        class="form-input f-13 w-full px-3 py-2 rounded-md" placeholder="أدخل اسم المدير">
                </div>

                <div>
                    <label for="manager_id" class="form-label">
                        هوية المدير
                    </label>
                    <input type="text" id="manager_id" name="manager_id" class="form-input f-13 w-full px-3 py-2 rounded-md"
                        placeholder="أدخل هوية المدير">
                </div>
            </div>
        </div>

        <!-- معلومات العقد -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-file-contract"></i>
                معلومات العقد
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contract_number" class="form-label">
                        رقم العقد <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="contract_number" name="contract_number"
                        class="form-input f-13 w-full px-3 py-2 rounded-md" placeholder="أدخل رقم العقد" required>
                </div>
            </div>
        </div>

        <!-- المعلومات المالية -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-money-bill-wave"></i>
                المعلومات المالية
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Amount requested --}}
                <div>
                    <label for="amount_requested" class="form-label">
                        المبلغ المطلوب <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" id="amount_requested" name="amount_requested"
                            value="{{ old('amount_requested') }}" class="form-input f-13 w-full px-4 py-2 rounded-md pl-12"
                            placeholder="0" step="0.01" min="0" required>
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">ر.س</span>
                    </div>
                </div>

                {{-- Amount paid --}}
                <div>
                    <label for="amount_paid" class="form-label">
                        المبلغ المدفوع
                    </label>
                    <div class="relative">
                        <input type="number" id="amount_paid" name="amount_paid" value="{{ old('amount_paid') }}"
                            class="form-input f-13 w-full px-4 py-2 rounded-md pl-12" placeholder="0" step="0.01" min="0"
                            value="0">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">ر.س</span>
                    </div>
                </div>

                {{-- Amount remaining --}}
                <div>
                    <label for="amount_remaining" class="form-label">
                        المبلغ المتبقي
                    </label>
                    <div class="relative">
                        <input type="number" id="amount_remaining" name="amount_remaining"
                            value="{{ old('amount_remaining') }}"
                            class="form-input w-full px-4 py-2 rounded-md pl-12 bg-gray-100" placeholder="0" step="0.01"
                            readonly>
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">ر.س</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notes --}}
        <div class="form-section">
            <h3 class="section-title text-lg font-semibold text-gray-700 mb-3 flex items-center gap-2">
                <i class="fas fa-comment-dots text-[#1B7A75]"></i>
                ملاحظات الشكوى
            </h3>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
                <label for="complaint_notes" class="block text-sm font-medium text-gray-700 mb-2">
                    أضف أي ملاحظات أو تفاصيل إضافية حول الشكوى
                </label>

                <textarea id="complaint_notes" name="complaint_notes" rows="4"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-800 placeholder-gray-400 focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] outline-none transition"
                    placeholder="اكتب هنا أي تفاصيل أو ملاحظات إضافية...">{{ old('complaint_notes') }}</textarea>

                <p class="text-xs text-gray-500 mt-2">
                    يمكنك كتابة تفاصيل إضافية مثل ملاحظات حول العميل، العقد، أو أي نقاط مهمة للفريق.
                </p>
            </div>
        </div>

        <!--  Contract Attachment -->
        <div class="form-section">
            <h3 class="section-title">
                <i class="fas fa-paperclip"></i>
                مرفقات العقد
            </h3>

            <div id="attachmentsContainer" class="space-y-4">
                <!-- First Attachment Row -->
                <div class="attachment-item flex items-center gap-4 bg-gray-50 p-4 rounded-md">
                    <div class="flex-1">
                        <label class="form-label f-12 text-sm font-semibold">اسم المرفق</label>
                        <input type="text" name="attachment_names[]" class="form-input f-11 w-full"
                            placeholder="مثلاً: عقد العميل">
                    </div>
                    <div class="flex-1">
                        <label class="form-label f-12 text-sm font-semibold">اختر الملف</label>
                        <input type="file" name="attachment_files[]" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            class="form-input f-11 w-full">
                    </div>
                    <button type="button" class="remove-attachment text-red-500 hover:text-red-700 mt-6">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Add Button -->
            <button type="button" id="addAttachment"
                class="mt-4 bg-[#1B7A75] hover:bg-[#16615C] text-white f-12  px-4 py-2 rounded-md  flex items-center gap-2">
                <i class="fas fa-plus"></i>
                إضافة مرفق آخر
            </button>
        </div>

        <!-- أزرار الإجراءات -->
        <div class="flex flex-col sm:flex-row gap-4 justify-start">
            <button type="button" class="bg-[#CF9411] text-white f-13 px-6 py-2 rounded-md font-semibold">
                <i class="fas fa-times ml-2"></i>
                إلغاء
            </button>
            <button type="submit"
                class="bg-[#1B7A75] hover:bg-[#16615C] text-white f-12 px-6 py-2 rounded-md font-semibold">
                <i class="fas fa-save ml-2"></i>
                حفظ العميل
            </button>
        </div>
    </form>
@endsection