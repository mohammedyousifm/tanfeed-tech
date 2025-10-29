@extends('dashboard.partials.app')
@section('title', '')

@section('Content')

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 lg:hidden z-40"></div>

    <!-- Sidebar -->
    @include('dashboard.partials.sidebar')

    <!-- Main Content Area -->
    <div id="mainContent" class="main-content lg:mr-64 transition-all duration-300">
        <!-- Header -->
        @include('dashboard.partials.header')

        <!-- Main Content -->
        <main class="p-4 lg:p-6">

            <form id="clientForm" action="{{ route('merchant.complaints.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- معلومات العميل الأساسية -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        معلومات العميل الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- اسم العميل -->
                        <div>
                            <label for="client_name" class="form-label">
                                اسم العميل <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="client_name" name="client_name"
                                class="form-input w-full px-4 py-2 rounded-md" placeholder="أدخل اسم العميل" required>
                        </div>

                        <!-- رقم الهوية -->
                        <div>
                            <label for="client_national_id" class="form-label">
                                رقم الهوية <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="client_national_id" name="client_national_id"
                                class="form-input w-full px-4 py-2 rounded-md" placeholder="أدخل رقم الهوية" required>
                            <p id="national-id-error" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>

                        <!-- رقم الجوال الأساسي -->
                        <div>
                            <label for="phone_number1" class="form-label">
                                رقم الجوال الأساسي <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center border rounded-md px-2 py-1 bg-white">

                                <input type="tel" id="phone_number1" name="phone_number1"
                                    class="form-input w-full px-3 py-2 rounded-md focus:outline-none"
                                    placeholder="05xxxxxxxx" required>
                                <span class="text-gray-600 text-sm mr-2">966+</span>
                            </div>
                            <p id="phone1-error" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>

                        <!-- رقم جوال إضافي -->
                        <div>
                            <label for="phone_number2" class="form-label">
                                رقم جوال إضافي (اختياري)
                            </label>
                            <div class="flex items-center border rounded-md px-2 py-1 bg-white">

                                <input type="tel" id="phone_number2" name="phone_number2"
                                    class="form-input w-full px-3 py-2 rounded-md focus:outline-none"
                                    placeholder="05xxxxxxxx">
                                <span class="text-gray-600 text-sm mr-2">966+</span>
                            </div>
                            <p id="phone2-error" class="text-red-600 text-sm mt-1 hidden"></p>
                        </div>
                    </div>
                </div>

                <!-- ✅ JavaScript Validation -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const nationalIdInput = document.getElementById('client_national_id');
                        const nationalError = document.getElementById('national-id-error');
                        const phoneInputs = [
                            { input: document.getElementById('phone_number1'), error: document.getElementById('phone1-error'), required: true },
                            { input: document.getElementById('phone_number2'), error: document.getElementById('phone2-error'), required: false }
                        ];

                        // رقم الهوية: يبدأ بـ 1 أو 2 وطوله 10
                        nationalIdInput.addEventListener('input', function () {
                            const value = nationalIdInput.value.trim();
                            if (!/^\d*$/.test(value)) {
                                nationalError.textContent = "❌ رقم الهوية يجب أن يحتوي على أرقام فقط.";
                                nationalError.classList.remove('hidden');
                                nationalIdInput.classList.add('border-red-500');
                                return;
                            }
                            if (value.length > 0 && !/^(1|2)\d{9}$/.test(value)) {
                                nationalError.textContent = "❌ رقم الهوية يجب أن يكون مكونًا من 10 أرقام ويبدأ بـ 1 أو 2 (هوية سعودية).";
                                nationalError.classList.remove('hidden');
                                nationalIdInput.classList.add('border-red-500');
                            } else {
                                nationalError.textContent = "";
                                nationalError.classList.add('hidden');
                                nationalIdInput.classList.remove('border-red-500');
                            }
                        });

                        // أرقام الجوال: يجب أن تبدأ بـ 05 وطولها 10 أرقام
                        phoneInputs.forEach(({ input, error, required }) => {
                            input.addEventListener('input', function () {
                                const value = input.value.trim();
                                if (!/^\d*$/.test(value)) {
                                    error.textContent = "❌ رقم الجوال يجب أن يحتوي على أرقام فقط.";
                                    error.classList.remove('hidden');
                                    input.classList.add('border-red-500');
                                    return;
                                }
                                if (value.length > 0 && !/^05\d{8}$/.test(value)) {
                                    error.textContent = "❌ رقم الجوال يجب أن يبدأ بـ 05 ويكون مكونًا من 10 أرقام.";
                                    error.classList.remove('hidden');
                                    input.classList.add('border-red-500');
                                } else {
                                    error.textContent = "";
                                    error.classList.add('hidden');
                                    input.classList.remove('border-red-500');
                                }
                            });
                        });
                    });
                </script>


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
                            <input type="text" id="commercial_name" name="commercial_name"
                                class="form-input w-full px-4 py-2 rounded-md" placeholder="أدخل الاسم التجاري">
                        </div>

                        <div>
                            <label for="commercial_record_number" class="form-label">
                                رقم السجل التجاري
                            </label>
                            <input type="text" id="commercial_record_number" name="commercial_record_number"
                                class="form-input w-full px-4 py-2 rounded-md" placeholder="أدخل رقم السجل التجاري">
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
                                class="form-input w-full px-4 py-2 rounded-md" placeholder="أدخل رقم العقد" required>
                        </div>

                        <div>
                            <label for="service_requested" class="form-label">
                                الخدمة المطلوبة <span class="text-red-500">*</span>
                            </label>
                            <select id="service_requested" name="service_requested"
                                class="form-input w-full px-4 py-2 rounded-md" required>
                                <option value="">اختر الخدمة</option>
                                <option value="تحصيل قبل المحكمة">تحصيل قبل المحكمة</option>
                                <option value="بعد التنفيذ">بعد التنفيذ 10</option>
                                <option value="1إجراء قضائي أعلى من 500 الف 15">1إجراء قضائي أعلى من 500 الف 15</option>
                                <option value="إجراء قضائي اقل من 500 الف">إجراء قضائي اقل من 500 الف</option>
                                <option value="تحصيل الديون المتعثرة">تحصيل الديون المتعثرة</option>
                            </select>
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
                        <div>
                            <label for="amount_requested" class="form-label">
                                المبلغ المطلوب <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" id="amount_requested" name="amount_requested"
                                    class="form-input w-full px-4 py-2 rounded-md pl-12" placeholder="0.00" step="0.01"
                                    min="0" required>
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">ر.س</span>
                            </div>
                        </div>

                        <div>
                            <label for="amount_paid" class="form-label">
                                المبلغ المدفوع
                            </label>
                            <div class="relative">
                                <input type="number" id="amount_paid" name="amount_paid"
                                    class="form-input w-full px-4 py-2 rounded-md pl-12" placeholder="0.00" step="0.01"
                                    min="0" value="0">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">ر.س</span>
                            </div>
                        </div>

                        <div>
                            <label for="amount_remaining" class="form-label">
                                المبلغ المتبقي
                            </label>
                            <div class="relative">
                                <input type="number" id="amount_remaining" name="amount_remaining"
                                    class="form-input w-full px-4 py-2 rounded-md pl-12 bg-gray-100" placeholder="0.00"
                                    step="0.01">
                                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">ر.س</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- مرفقات العقد -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-paperclip"></i>
                        مرفقات العقد
                    </h3>
                    <div>
                        <label class="form-label">
                            تحميل الملفات
                        </label>
                        <div class="file-upload-area p-8 rounded-md text-center" id="fileUploadArea">
                            <input type="file" id="contract_attachments" name="contract_attachments[]" class="hidden"
                                multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 mb-2">اسحب الملفات وأفلتها هنا أو</p>
                            <button type="button" class="text-green font-semibold hover:underline" id="browseFiles">
                                تصفح الملفات
                            </button>
                            <p class="text-xs text-gray-500 mt-2">PDF, DOC, DOCX, JPG, PNG (حتى 10 ميجابايت لكل ملف)</p>
                        </div>
                        <div id="fileList" class="mt-4 space-y-2"></div>
                    </div>
                </div>

                <!-- أزرار الإجراءات -->
                <div class="flex flex-col sm:flex-row gap-4 justify-start">
                    <button type="button" class="btn-secondary px-2  py-2  rounded-md font-semibold">
                        <i class="fas fa-times ml-2"></i>
                        إلغاء
                    </button>
                    <button type="submit" class="btn-primary px-2 py-2 rounded-md font-semibold">
                        <i class="fas fa-save ml-2"></i>
                        حفظ العميل
                    </button>
                </div>
            </form>

        </main>
    </div>

@endsection



<style>
    #fileUploadArea {
        border: 2px dashed #ccc;
        transition: all 0.3s ease;
    }

    #fileUploadArea.border-green-500 {
        border-color: #16a34a !important;
        /* Tailwind green-600 */
    }

    .header {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(10px);
    }

    .form-input {
        transition: var(--transition);
        border: 1px solid #e5e7eb;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--color-green);
        box-shadow: 0 0 0 3px rgba(29, 153, 66, 0.1);
    }

    .form-label {
        font-weight: 600;
        font-size: 13px;
        color: var(--color-black);
        margin-bottom: 0.5rem;
        display: block;
    }

    .btn-primary {
        background-color: var(--color-green);
        color: var(--color-white);
        transition: var(--transition);
    }

    .btn-primary:hover {
        background-color: #166f33;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(29, 153, 66, 0.3);
    }

    .btn-secondary {
        background-color: var(--color-white);
        color: var(--color-black);
        border: 2px solid #e5e7eb;
        transition: var(--transition);
        font-size: 12px;
    }

    .btn-secondary:hover {
        border-color: var(--color-green);
        color: var(--color-green);
    }

    .file-upload-area {
        border: 2px dashed #e5e7eb;
        transition: var(--transition);
        cursor: pointer;
    }

    .file-upload-area:hover {
        border-color: var(--color-green);
        background-color: rgba(29, 153, 66, 0.05);
    }

    .file-upload-area.dragover {
        border-color: var(--color-green);
        background-color: rgba(29, 153, 66, 0.1);
    }

    .form-section {
        background-color: var(--color-white);
        border-radius: var(--radius-md);
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: .8rem;
        font-weight: 700;
        color: var(--color-black);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--color-gray);
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-left: 0.5rem;
        color: var(--color-green);
    }

    @media (min-width: 1024px) {
        .sidebar.collapsed {
            transform: translateX(0);
        }

        .main-content.expanded {
            margin-right: 0;
        }
    }
</style>