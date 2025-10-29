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
        <main class="p-4 lg:p-4">

            <!-- Page Title -->
            <h1 class="text-1xl font-bold text-gray-800 mb-6">قائمة الطلبات</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('lawyer.complaints.index') }}" class="mb-6">
                <div class="max-w-md w-full">
                    <div class="relative flex  items-center">
                        <!-- Search Input -->
                        <input style="font-size: 12px" type="search" name="search" value="{{ request('search') }}"
                            placeholder="ابحث بالاسم، رقم الطلب أو 	رقم العقد..."
                            class="block w-full p-2   f-12 border border-green rounded bg-white text-gray-800 transition shadow-soft" />

                        <!-- Search Button -->
                        <button type="submit"
                            class="bg-green text-white text-sm  p-2 rounded border border-green hover-up shadow-soft transition"
                            style="background-color: var(--color-green); border-color: var(--color-green);">
                            بحث
                        </button>
                    </div>
                </div>
            </form>

            <!-- Table Container -->
            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="font-size: 11px">رقم الطلب</th>
                                <th style="font-size: 11px">اسم التاجر</th>
                                <th style="font-size: 11px">اسم العميل</th>
                                <th style="font-size: 11px">رقم العقد</th>
                                <th style="font-size: 11px">المبلغ المطلوب</th>
                                <th style="font-size: 11px">المبلغ المتبقي</th>
                                <th style="font-size: 11px">المحصلين</th>
                                <th style="font-size: 11px">الحالة</th>
                                <th style="font-size: 11px">المتابعات</th>
                                <th style="font-size: 11px">التحصيلات</th>
                                <th style="font-size: 11px">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach ($complaints as $complaint)
                                <tr onclick="window.location='{{ route('lawyer.complaints.show', $complaint->id) }}'"
                                    class="cursor-pointer hover:bg-gray-50 transition">
                                    <!-- ID -->
                                    <td style="font-size: 11px" class="px-3 py-2 text-center text-gray-700">
                                        {{ $loop->iteration }}
                                    </td>

                                    <!-- Serial -->
                                    <td style="font-size: 11px" class="px-3 py-2 font-semibold text-gray-800">
                                        #{{ $complaint->serial_number }}</td>

                                    <!-- User -->
                                    <td style="font-size: 11px" class="px-3 py-2 text-gray-600">{{ $complaint->user->name }}
                                    </td>

                                    <!-- Client -->
                                    <td style="font-size: 11px" class="px-3 py-2 font-semibold text-gray-700">
                                        {{ $complaint->client_name }}
                                    </td>

                                    <!-- Contract -->
                                    <td style="font-size: 11px" class="px-3 py-2">{{ $complaint->contract_number }}</td>

                                    <!-- Amount Requested -->
                                    <td style="font-size: 11px" class="px-3 py-2 font-semibold text-green-600">
                                        {{ number_format($complaint->amount_requested, 0) }} ر.س
                                    </td>

                                    <!-- Amount Paid -->
                                    <td style="font-size: 11px" class="px-3 py-2 font-semibold text-yellow-600">
                                        {{ number_format($complaint->amount_paid, 0) }} ر.س
                                    </td>

                                    <!-- Collectors -->
                                    <td class="px-3 py-2">
                                        @php
                                            $collectorIds = is_array($complaint->collector_ids)
                                                ? $complaint->collector_ids
                                                : json_decode($complaint->collector_ids, true);

                                            $collectors = \App\Models\User::whereIn('id', $collectorIds ?? [])->get();
                                        @endphp

                                        @if ($collectors->isEmpty())
                                            <button onclick="event.stopPropagation(); openCollectorModal({{ $complaint->id }})"
                                                class="text-blue-600 hover:underline text-sm font-medium">
                                                اختر المحصلين
                                            </button>
                                        @else
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($collectors as $collector)
                                                    <span style="font-size: 11px"
                                                        onclick="event.stopPropagation(); openCollectorModal({{ $complaint->id }})"
                                                        class="cursor-pointer px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs hover:bg-green-200 transition">
                                                        {{ $collector->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Status -->
                                    <td class="px-2 py-2 text-center">
                                        <button style="font-size: 11px"
                                            onclick="event.stopPropagation(); openStatusModal({{ $complaint->id }}, '{{ $complaint->status }}')"
                                            class="px-2 py-1 rounded-full  font-semibold transition hover:opacity-80
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
                                        <a style="font-size: 11px"
                                            href="{{ route('lawyer.complaints.followup', $complaint->id) }}"
                                            onclick="event.stopPropagation()" class=" hover:underline text-sm">
                                            المتابعات
                                        </a>
                                    </td>

                                    <!-- Collections -->
                                    <td class="px-3 py-2 text-center">
                                        <a style="font-size: 11px"
                                            href="{{ route('lawyer.complaints.collections', $complaint->id) }}"
                                            onclick="event.stopPropagation()" class=" hover:underline text-sm">
                                            التحصيلات
                                        </a>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-3 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <button onclick="event.stopPropagation(); confirmDelete({{ $complaint->id }})"
                                                class="action-btn delete text-red-600 hover:text-red-800" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <!-- Modal لتغيير حالة الشكوى -->
                <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-strong w-full max-w-md mx-4 p-6 relative">
                        <h3 class="text-xl font-bold text-green mb-4">تغيير حالة الشكوى</h3>
                        <form id="statusForm" method="POST" action="">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="complaint_id" id="complaintId">

                            <div class="mb-4">
                                <label class="block mb-1 text-gray-700 font-semibold">اختر الحالة الجديدة</label>
                                <select name="status" id="statusSelect"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                                    <option value="accepted">قبول</option>
                                    <option value="suspended">تعليق</option>
                                    <option value="pending">قيد المراجعة</option>
                                    <option value="in_progress">قيد التنفيذ</option>
                                    <option value="completed">مكتمل</option>
                                    <option value="cancelled">ملغي</option>
                                </select>
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="closeStatusModal()"
                                    class="btn btn-yellow hover-up">إلغاء</button>
                                <button type="submit" class="btn btn-green hover-up">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal لاختيار المحصلين -->
                <div id="collectorModal"
                    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6 relative">
                        <h3 class="text-xl font-bold text-green mb-4">تعيين المحصلين</h3>
                        <form id="collectorForm" method="POST" action="">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="complaint_id" id="collectorComplaintId">

                            <div class="mb-4">
                                <label class="block mb-2 font-semibold text-gray-700">اختر المحصلين</label>
                                <select name="collector_ids[]" id="collectorSelect" multiple
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                                    @foreach (\App\Models\User::where('role', 'collector')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="closeCollectorModal()"
                                    class="btn btn-yellow hover-up">إلغاء</button>
                                <button type="submit" class="btn btn-green hover-up">حفظ</button>
                            </div>
                        </form>
                    </div>
                </div>


                <script>
                    // فتح النافذة
                    function openStatusModal(id, currentStatus) {
                        document.getElementById('statusModal').classList.remove('hidden');
                        document.getElementById('statusModal').classList.add('flex');
                        document.getElementById('complaintId').value = id;
                        document.getElementById('statusSelect').value = currentStatus;
                        document.getElementById('statusForm').action = `/lawyer/complaints/{id}/status`;
                        document.getElementById('statusForm').action = `/lawyer/complaints/${id}/status`;

                    }

                    // إغلاق النافذة
                    function closeStatusModal() {
                        document.getElementById('statusModal').classList.add('hidden');
                        document.getElementById('statusModal').classList.remove('flex');
                    }

                    // فتح المودال
                    function openCollectorModal(id) {
                        document.getElementById('collectorModal').classList.remove('hidden');
                        document.getElementById('collectorModal').classList.add('flex');
                        document.getElementById('collectorComplaintId').value = id;
                        document.getElementById('collectorForm').action = `/lawyer/complaints/${id}/collectors`;
                    }

                    // إغلاق المودال
                    function closeCollectorModal() {
                        document.getElementById('collectorModal').classList.add('hidden');
                        document.getElementById('collectorModal').classList.remove('flex');
                    }
                </script>





                <!-- Pagination -->
                <div class="p-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-600">عرض 1 - 5 من أصل 5 عملاء</p>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100 disabled:opacity-50"
                            disabled>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button class="px-4 py-2 rounded-md bg-green text-white font-semibold">1</button>
                        <button
                            class="px-4 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">2</button>
                        <button
                            class="px-4 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">3</button>
                        <button class="px-3 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>



    </main>
    </div>

@endsection

<style>
    .f-12 {
        font-size: 12px;
    }

    .f-11 {
        font-size: 11px;
    }
</style>