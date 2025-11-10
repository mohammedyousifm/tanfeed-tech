@extends('dashboard.partials.app')
@section('title', '')

@section('Content')


    <!-- Page Title -->
    <h1 class="text-1xl font-bold text-gray-800 mb-4">قائمة الطلبات</h1>


    {{-- 🔍 Search Form --}}
    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-2 rounded-lg shadow-sm border border-gray-200">
        <form method="GET" action="{{ route('collector.complaints.index') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="flex-grow rounded-s-lg f-12 border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث اسم العميل، رقم الطلب، رقم العقد أو المدينة..." aria-label="Search"
                    id="exampleFormControlInput3" />

                <button type="submit"
                    class="bg-[#1B7A75] f-12 hover:bg-[#16615C] text-white rounded-e-lg px-6 py-2 text-sm font-medium transition duration-200 shadow-sm">
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="f-12">رقم الطلب</th>
                        <th class="f-12">اسم التاجر</th>
                        <th class="f-12">اسم العميل</th>
                        <th class="f-12">رقم العقد</th>
                        <th class="f-12">المبلغ المتبقي</th>
                        <th class="f-11">تاريخ الطلب</th>
                        <th class="f-12">الحالة</th>
                        <th class="f-12">المتابعات</th>
                        <th class="f-12">التحصيلات</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                    @forelse ($complaints as $complaint)
                        <tr onclick="window.location='{{ route('collector.complaints.show', $complaint->id) }}'"
                            class="cursor-pointer hover:bg-gray-50 transition">
                            <td class="f-12">{{ $complaint->serial_number }}</td>
                            <td class="f-12 px-3 py-2 text-gray-600">{{ $complaint->user->name }}</td>
                            <td class="f-12 font-semibold">{{ $complaint->client_name }}</td>
                            <td class="f-12">{{ $complaint->contract_number }}</td>
                            <td class="f-12 font-semibold text-yellow">{{  number_format($complaint->amount_paid, 0) }} ر.س
                            </td>
                            <!-- created at  -->
                            <td class="px-3 py-2 f-11 font-semibold text-yellow-600">
                                {{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d')  }}
                            </td>
                            <td class="f-12">
                                <button
                                    class="status-badge  status-active px-3 py-1 rounded-full text-sm font-semibold
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @if($complaint->status == 'pending') bg-yellow-100 text-yellow-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @elseif($complaint->status == 'in_progress') bg-blue-100 text-blue-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @elseif($complaint->status == 'completed') bg-green-100 text-green-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @elseif($complaint->status == 'cancelled') bg-red-100 text-red-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @else bg-gray-100 text-gray-700 @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        transition hover:opacity-80"
                                    onclick="openStatusModal({{ $complaint->id }}, '{{ $complaint->status }}')">
                                    {{ $complaint->status_label }}
                                </button>
                            </td>


                            <td class="f-12"> <a
                                    href="{{ route('collector.complaints.followup', $complaint->id) }}">المتابعات</a>
                            </td>
                            <td class="f-12"><a
                                    href="{{ route('collector.complaints.collections', $complaint->id) }}">التحصيلات</a>
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
                        <button type="button" onclick="closeStatusModal()" class="btn btn-yellow hover-up">إلغاء</button>
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
        </script>


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
    </div>


@endsection