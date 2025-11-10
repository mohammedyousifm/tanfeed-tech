@extends('dashboard.partials.app')
@section('title', 'الطلبات الملغية')

@section('Content')


    <!-- Page Title -->
    <h1 class="text-1xl font-bold text-gray-800 mb-6">الطلبات الملغية</h1>

    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
        {{-- 🔍 Search Form --}}
        <form method="GET" action="{{ route('lawyer.complaints.neglectedcontracts') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="flex-grow rounded-s-lg border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث بالاسم، رقم الطلب أو رقم العقد..." aria-label="Search"
                    id="exampleFormControlInput3" />

                <button type="submit"
                    class="bg-[#1B7A75] hover:bg-[#16615C] text-white rounded-e-lg px-6 py-2 text-sm font-medium transition duration-200 shadow-sm">
                    بحث
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
                        <th style="font-size: 11px">رقم الطلب</th>
                        <th style="font-size: 11px">اسم التاجر</th>
                        <th style="font-size: 11px">اسم العميل</th>
                        <th style="font-size: 11px">رقم العقد</th>
                        <th style="font-size: 11px">المبلغ المطلوب</th>
                        <th style="font-size: 11px">المبلغ المتبقي</th>
                        <th style="font-size: 11px">المحصل</th>
                        <th style="font-size: 11px">الحالة</th>
                        <th style="font-size: 11px">المتابعات</th>
                        <th style="font-size: 11px">التحصيلات</th>
                        <th style="font-size: 11px">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($complaints as $complaint)
                        <tr onclick="window.location='{{ route('lawyer.complaints.show', $complaint->id) }}'"
                            class="cursor-pointer hover:bg-gray-50 transition">


                            <!-- Serial -->
                            <td style="font-size: 11px" class="px-3 py-2 font-semibold text-gray-800">
                                {{ $complaint->serial_number }}
                            </td>

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
                                <a style="font-size: 11px" href="{{ route('lawyer.complaints.followup', $complaint->id) }}"
                                    onclick="event.stopPropagation()" class=" hover:underline text-sm">
                                    المتابعات
                                </a>
                            </td>

                            <!-- Collections -->
                            <td class="px-3 py-2 text-center">
                                <a style="font-size: 11px" href="{{ route('lawyer.complaints.collections', $complaint->id) }}"
                                    onclick="event.stopPropagation()" class=" hover:underline text-sm">
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
                    عقود مهملة
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
                            <button class="px-2 py-1 rounded-md bg-green text-white font-semibold">{{ $page }}</button>
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

        <!-- Modal لاختيار المحصلين -->
        <div id="collectorModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
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
                        <button type="button" onclick="closeCollectorModal()" class="btn btn-yellow hover-up">إلغاء</button>
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




    </div>
    </main>
    </div>



    </main>
    </div>

@endsection