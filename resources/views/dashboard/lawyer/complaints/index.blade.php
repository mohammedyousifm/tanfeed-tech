@extends('dashboard.partials.app')
@section('title', 'تنفيذ تك - قائمة الطلبات')

@section('Content')


    <!-- Page Title -->
    <h1 class="text-1xl font-bold text-gray-800 mb-4">قائمة الطلبات</h1>


    {{-- 🔍 Search Form --}}
    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-2 rounded-lg shadow-sm border border-gray-200">
        <form method="GET" action="{{ route('lawyer.complaints.index') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="flex-grow rounded-s-lg f-12 border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث بالاسم، رقم الطلب، رقم العقد أو المدينة..." aria-label="Search"
                    id="exampleFormControlInput3" />

                <button type="submit"
                    class="bg-[#1B7A75] f-12 hover:bg-[#16615C] text-white rounded-e-lg px-6 py-2 text-sm font-medium transition duration-200 shadow-sm">
                    بحث
                </button>
            </div>
        </form>



        {{-- 📤 Export Button --}}
        <a href="{{ route('lawyer.complaints.export-unavailable') }}"
            class="inline-flex f-12 items-center justify-center bg-[#1B7A75] hover:bg-[#16615C] text-white rounded-md px-5 py-2 text-sm font-medium transition duration-200 shadow-sm w-full md:w-auto text-center">
            <i class="fas fa-file-excel ms-2 text-white/80"></i>
            تصدير الأرقام غير المتاحة
        </a>
    </div>

    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-2 rounded-lg shadow-sm border border-gray-200">
        <form method="GET" action="{{ route('lawyer.complaints.index') }}" class="w-full md:w-1/3">
            <div class="flex items-center gap-2">
                <select name="status"
                    class="flex-grow rounded-lg f-12 border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-3 py-2 text-sm outline-none">
                    <option value="">جميع الحالات</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>قيد المعالجة
                    </option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتملة</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغاة</option>
                </select>

                <button type="submit"
                    class="bg-[#1B7A75] f-12 hover:bg-[#16615C] text-white rounded-lg px-4 py-2 text-sm font-medium transition duration-200 shadow-sm">
                    تصفية
                </button>
            </div>
        </form>
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
                                        {{ $complaint->serial_number }}
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

                                            <form action="{{ route('lawyer.complaints.destroy', $complaint->id) }}" method="POST"
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

                <!-- Pagination -->
                @if ($complaints->hasPages())
                    <div class="p-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">

                        <!-- Info -->
                        <p class="f-11 text-gray-600">
                            عرض {{ $complaints->firstItem() }} - {{ $complaints->lastItem() }} من أصل {{ $complaints->total() }}
                            الطلبات
                        </p>

                        <!-- Pagination Buttons -->
                        <div class="flex gap-2 items-center">

                            {{-- Previous Page --}}
                            @if ($complaints->onFirstPage())
                                <button class="px-2 py-1 rounded-md border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            @else
                                <a href="{{ $complaints->previousPageUrl() }}"
                                    class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($complaints->links()->elements[0] ?? [] as $page => $url)
                                @if ($page == $complaints->currentPage())
                                    <button
                                        class="px-2 py-1 rounded-md bg-[#1B7A75] hover:bg-[#16615C] text-white text-white font-semibold">{{ $page }}</button>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next Page --}}
                            @if ($complaints->hasMorePages())
                                <a href="{{ $complaints->nextPageUrl() }}"
                                    class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @else
                                <button class="px-2 py-1 rounded-md border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endif




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


@endsection
