@extends('dashboard.partials.app')
@section('title', 'تفاصيل التاجر')

@section('Content')


    <div class="max-w-7xl mx-auto space-y-8">

        <!-- 🧾 Merchant Info Card -->
        <div class="bg-white rounded-2xl shadow border border-gray-100 p-4 mb-8">
            <h2 class="text-1xl font-bold text-[#1B7A75] mb-4 border-b-2 border-[#1B7A75]/10 pb-2">
                🧾 معلومات التاجر
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-700 leading-6">
                <div><strong>رقم التاجر:</strong> <span class="text-gray-900">#{{ $merchant->client_number }}</span></div>
                <div><strong>اسم التاجر:</strong> <span class="text-gray-900">{{ $merchant->name }}</span></div>
                <div><strong>البريد الإلكتروني:</strong> <span class="text-gray-900">{{ $merchant->email }}</span></div>
                <div><strong>المدينة: </strong> <span class="text-gray-900">{{ $merchant->companyinfo->city }}</span></div>
                <div><strong>الحي:</strong> <span
                        class="text-gray-900">{{ $merchant->companyinfo->district ?? 'لا يوجد' }}</span></div>

                <div>
                    <strong>الحالة:</strong>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold shadow-sm
                                                                                                                                                                                                                                                                                                    @if($merchant->status == 'active') bg-green-100 text-green-700
                                                                                                                                                                                                                                                                                                    @elseif($merchant->status == 'pending') bg-yellow-100 text-yellow-700
                                                                                                                                                                                                                                                                                                    @elseif($merchant->status == 'suspended') bg-blue-100 text-blue-700
                                                                                                                                                                                                                                                                                                    @else bg-gray-100 text-gray-700 @endif">
                        {{ $merchant->status_label }}
                    </span>
                </div>

                <div>
                    <strong>تاريخ التسجيل:</strong>
                    <span class="text-gray-900">{{ \Carbon\Carbon::parse($merchant->created_at)->format('Y-m-d') }}</span>
                </div>
                <div>
                    <strong>آخر تسجيل دخول:</strong>
                    <span class="text-gray-900">
                        {{ $merchant->last_login_at ? \Carbon\Carbon::parse($merchant->last_login_at)->format('Y-m-d H:i') : 'لم يسجل دخول' }}
                    </span>
                </div>
            </div>
        </div>



        <!-- 🏢 Company Info Card -->
        @if($merchant->companyinfo)
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-4">
                <h2 class="text-1xl font-bold text-[#1B7A75] mb-4 border-b-2 border-[#1B7A75]/10 pb-2">
                    🏢 معلومات المنشأة
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-gray-700 leading-6">
                    <div><strong>اسم المنشأة:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->company_name ?? 'لا يوجد' }}</span></div>
                    <div><strong>رقم المنشأة:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->establishment_number ?? 'لا يوجد' }}</span></div>
                    <div><strong>اسم المدير:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->manager_name ?? 'لا يوجد' }}</span></div>
                    <div><strong>الهاتف 1:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->phone_1 ?? 'لا يوجد' }}</span></div>
                    <div><strong>الهاتف 2:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->phone_2 ?? 'لا يوجد' }}</span></div>
                    <div><strong>رقم هوية المدير:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->national_id ?? 'لا يوجد' }}</span></div>
                    <div><strong>البريد الإلكتروني للشركة:</strong> <span
                            class="text-gray-900">{{ $merchant->companyinfo->company_email ?? 'لا يوجد' }}</span></div>

                    @if($merchant->companyinfo->commercial_record_pdf)
                        <div>
                            <strong>السجل التجاري:</strong>
                            <a href="{{ asset('storage/' . $merchant->companyinfo->commercial_record_pdf) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-[#1B7A75] hover:text-[#16615C] underline transition duration-150">
                                📄 عرض السجل
                            </a>
                        </div>
                    @endif
                    @if($merchant->companyinfo->owner_id_pdf)
                        <div>
                            <strong>هوية المالك:</strong>
                            <a href="{{ asset('storage/' . $merchant->companyinfo->owner_id_pdf) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-[#1B7A75] hover:text-[#16615C] underline transition duration-150">
                                📄 عرض السجل
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- contract -->
        @if($merchant->contracts && $merchant->contracts->count() > 0)
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-5 mb-8">
                <h2 class="text-xl font-bold text-[#1B7A75] mb-4 border-b-2 border-[#1B7A75]/10 pb-2 flex items-center gap-2">
                    🧾 عقود التاجر
                </h2>

                <div class="space-y-3">
                    @foreach($merchant->contracts as $contract)
                        <div
                            class="flex items-center justify-between border border-gray-100 rounded-lg p-3 hover:shadow-sm transition">
                            <div class="flex items-center gap-3">
                                {{-- Icon by file type --}}
                                @if($contract->file_type === 'Contract')
                                    <span class="text-yellow-600 text-xl">📄</span>
                                @elseif($contract->file_type === 'Agency Form')
                                    <span class="text-blue-600 text-xl">🏢</span>
                                @else
                                    <span class="text-gray-400 text-xl">📁</span>
                                @endif

                                {{-- File info --}}
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">
                                        {{ $contract->file_type === 'Contract' ? 'عقد التاجر' : 'نموذج الوكالة' }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        تم الرفع بتاريخ {{ $contract->created_at->format('Y/m/d - H:i') }}
                                    </p>
                                </div>
                            </div>

                            {{-- View / Download --}}
                            <a href="{{ asset('storage/' . $contract->contract_file) }}" target="_blank"
                                class="inline-flex items-center gap-1 text-[#1B7A75] hover:text-[#16615C] font-medium text-sm underline transition">
                                📥 عرض الملف
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            {{-- send contract --}}
            <div class="bg-white rounded-2xl shadow border border-gray-100 p-4 mb-8">
                <h2 class="text-1xl font-bold text-[#1B7A75] mb-4 border-b-2 border-[#1B7A75]/10 pb-2">
                    إرسال العقد للتاجر
                </h2>
                <form action="{{ route('lawyer.merchant.sendContract', $merchant->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-[#1B7A75] text-white f-13 rounded hover:bg-yellow-700">
                        إرسال العقد
                    </button>
                </form>
            </div>
        @endif


        <!-- 🔍 Filter + Complaints Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">

                <!-- Filter/Search -->
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="tableSearch" placeholder="ابحث في الطلبات..."
                        class="w-full border-gray-300 rounded-lg pl-10 pr-3 py-2 text-sm focus:ring-green-500 focus:border-green-500">
                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                </div>

                <h2 class="f-12 font-bold text-gray-800">طلبات التاجر</h2>


            </div>

            <!-- Table Container -->
            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="data-table text-center">
                        <thead>
                            <tr>
                                <th class="f-11">رقم الطلب</th>
                                <th class="f-11">اسم التاجر</th>
                                <th class="f-11">اسم العميل</th>
                                <th class="f-11">رقم العقد</th>
                                <th class="f-11">المبلغ المتبقي</th>
                                <th class="f-11">حالة الهاتف</th>
                                <th class="f-11">تاريخ الطلب</th>
                                <th class="f-11">المحصل</th>
                                <th class="f-11">الحالة</th>
                                <th class="f-11">المتابعات</th>
                                <th class="f-11">التحصيلات</th>
                                <th class="f-11">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse ($complaints as $complaint)
                                <tr onclick="window.location='{{ route('lawyer.complaints.show', $complaint->id) }}'"
                                    class="cursor-pointer hover:bg-gray-50 transition">

                                    <!-- Serial -->
                                    <td class="px-3 f-11 py-2 font-semibold text-gray-800">
                                        {{ $complaint->serial_number }}#
                                    </td>

                                    <!-- User -->
                                    <td class="px-3 f-11 py-2 text-gray-600">{{ $complaint->user->name }}
                                    </td>

                                    <!-- Client -->
                                    <td class="px-3 f-11 py-2 font-semibold text-gray-700">
                                        {{ $complaint->client_name }}
                                    </td>

                                    <!-- Contract -->
                                    <td class="px-3 f-11 py-2">{{ $complaint->contract_number }}</td>

                                    <th class="px-3 f-11 py-2">{{ number_format($complaint->amount_remaining, 0) }} ر.س</th>

                                    <!-- phone status -->
                                    <td class="px-2 py-2 text-center">
                                        <button
                                            onclick="event.stopPropagation(); openPhonestatusModal({{ $complaint->id }}, '{{ $complaint->phone_status }}')"
                                            class="px-2 py-1 f-11 rounded-full  font-semibold transition hover:opacity-80
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      @if($complaint->phone_status == 'available') bg-green-100 text-green-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @elseif($complaint->phone_status == 'not_available') bg-red-100 text-red-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @else bg-gray-100 text-gray-700 @endif">
                                            {{ $complaint->phone_status_label }}
                                        </button>
                                    </td>

                                    <!-- created at  -->
                                    <td class="px-3 py-2 f-11 font-semibold text-yellow-600">
                                        {{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d')  }}
                                    </td>

                                    <!-- Collectors -->
                                    <td class="px-3 py-2">
                                        @php
                                            // Get collector object by single collector_id
                                            $collector = \App\Models\User::find($complaint->collector_id);
                                        @endphp

                                        @if (!$collector)
                                            <button onclick="event.stopPropagation(); openCollectorModal({{ $complaint->id }})"
                                                class="hover:underline f-11 text-sm font-medium">
                                                اختر المحصل
                                            </button>
                                        @else
                                            <span onclick="event.stopPropagation(); openCollectorModal({{ $complaint->id }})"
                                                class="cursor-pointer f-11 px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs hover:bg-green-200 transition">
                                                {{ $collector->name }}
                                            </span>
                                        @endif
                                    </td>


                                    <!-- Status -->
                                    <td class="px-2 py-2 text-center">
                                        <button
                                            onclick="event.stopPropagation(); openStatusModal({{ $complaint->id }}, '{{ $complaint->status }}')"
                                            class="px-2 py-1 f-11 rounded-full  font-semibold transition hover:opacity-80
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @if($complaint->status == 'pending') bg-yellow-100 text-yellow-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif($complaint->status == 'in_progress') bg-blue-100 text-blue-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif($complaint->status == 'completed') bg-green-100 text-green-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @elseif($complaint->status == 'cancelled') bg-red-100 text-red-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                @else bg-gray-100 text-gray-700 @endif">
                                            {{ $complaint->status_label }}
                                        </button>
                                    </td>

                                    <!-- Followups -->
                                    <td class="px-3 py-2 text-center">
                                        <a href="{{ route('lawyer.complaints.followup', $complaint->id) }}"
                                            onclick="event.stopPropagation()" class="f-11 hover:underline text-sm">
                                            المتابعات
                                        </a>
                                    </td>

                                    <!-- Collections -->
                                    <td class="px-3 py-2 text-center">
                                        <a href="{{ route('lawyer.complaints.collections', $complaint->id) }}"
                                            onclick="event.stopPropagation()" class="f-11 hover:underline text-sm">
                                            التحصيلات
                                        </a>
                                    </td>


                                    <!-- Actions -->
                                    <td class="px-3 py-2 text-center">
                                        <div class="flex justify-center gap-2">

                                            <form action="{{ route('lawyer.complaints.destroy', $complaint->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الطلب؟');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" onclick="event.stopPropagation()"
                                                    class="text-red-600 hover:text-red-800" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-6 text-center text-gray-500">لا توجد طلبات.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>




                {{-- Modals --}}
                @include('dashboard.lawyer.models.phone-status')
                @include('dashboard.lawyer.models.complaints-status')
                @include('dashboard.lawyer.models.select-collector')
                <script>
                    // 🟢 فتح نافذة تغيير الحالة
                    function openStatusModal(id, currentStatus) {
                        const modal = document.getElementById('statusModal');
                        const statusSelect = document.getElementById('statusSelect');
                        const suspendedContainer = document.getElementById('suspendedReasonContainer');
                        const suspendedInput = document.getElementById('suspended_reason');
                        const complaintIdInput = document.getElementById('complaintId');
                        const form = document.getElementById('statusForm');
                        const currentStatusContainer = document.getElementById('currentStatusContainer');
                        const currentStatusLabel = document.getElementById('currentStatusLabel');

                        // إعداد البيانات
                        complaintIdInput.value = id;
                        form.action = `/lawyer/complaints/${id}/status`;

                        // عرض الحالة الحالية
                        currentStatusContainer.classList.remove('hidden');
                        currentStatusLabel.textContent = getArabicStatus(currentStatus);

                        // 🔥 إظهار جميع الخيارات أولاً (في حال تم إخفاؤها من قبل)
                        Array.from(statusSelect.options).forEach(opt => opt.classList.remove('hidden'));

                        // 🔥 إخفاء الحالة الحالية فقط
                        const currentOption = Array.from(statusSelect.options).find(opt => opt.value === currentStatus);
                        if (currentOption) currentOption.classList.add('hidden');

                        // 🔥 إعادة الضبط للحالة الافتراضية (أول اختيار متاح)
                        const firstVisible = Array.from(statusSelect.options).find(opt => !opt.classList.contains('hidden'));
                        statusSelect.value = firstVisible ? firstVisible.value : '';

                        // 🎯 ضبط حقل سبب التعليق حسب الحالة
                        if (statusSelect.value === 'suspended') {
                            suspendedContainer.classList.remove('hidden');
                            suspendedInput.required = true;
                        } else {
                            suspendedContainer.classList.add('hidden');
                            suspendedInput.required = false;
                            suspendedInput.value = '';
                        }

                        modal.classList.remove('hidden');
                        modal.classList.add('flex');
                    }

                    // 🔴 إغلاق النافذة
                    function closeStatusModal() {
                        const modal = document.getElementById('statusModal');
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }

                    // ✅ مراقبة تغيير الحالة بشكل دائم
                    document.addEventListener('change', function (event) {
                        if (event.target && event.target.id === 'statusSelect') {
                            const suspendedContainer = document.getElementById('suspendedReasonContainer');
                            const suspendedInput = document.getElementById('suspended_reason');

                            if (event.target.value === 'suspended') {
                                suspendedContainer.classList.remove('hidden');
                                suspendedInput.required = true;
                            } else {
                                suspendedContainer.classList.add('hidden');
                                suspendedInput.required = false;
                                suspendedInput.value = '';
                            }
                        }
                    });

                    // 🧭 ترجمة الحالات (عربي للعرض فقط)
                    function getArabicStatus(status) {
                        switch (status) {
                            case 'accepted': return 'قبول';
                            case 'suspended': return 'تعليق';
                            case 'pending': return 'قيد المراجعة';
                            case 'in_progress': return 'قيد التنفيذ';
                            case 'completed': return 'مكتمل';
                            case 'cancelled': return 'ملغي';
                            default: return 'غير معروف';
                        }
                    }
                </script>

            </div>
        </div>
    </div>


    <!-- Filter Script -->
    <script>
        const searchInput = document.getElementById('tableSearch');
        const tableBody = document.getElementById('tableBody');
        searchInput.addEventListener('keyup', function () {
            const value = this.value.toLowerCase();
            const rows = tableBody.getElementsByTagName('tr');
            for (let row of rows) {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            }
        });
    </script>
@endsection
