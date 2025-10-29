@extends('dashboard.partials.app')
@section('title', 'تفاصيل التاجر')

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
        <main class="p-6 lg:p-10 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto space-y-8">

                <!-- 🧾 Merchant Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">معلومات التاجر</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                        <div><strong>رقم التاجر:</strong> #{{ $merchant->client_number }}</div>
                        <div><strong>اسم التاجر:</strong> {{ $merchant->name }}</div>
                        <div><strong>البريد الإلكتروني:</strong> {{ $merchant->email }}</div>

                        <div><strong>الحالة:</strong>
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                                                        @if($merchant->status == 'active') bg-green-100 text-green-700
                                                                        @elseif($merchant->status == 'pending') bg-yellow-100 text-yellow-700
                                                                        @elseif($merchant->status == 'suspended') bg-blue-100 text-blue-700
                                                                        @else bg-gray-100 text-gray-700 @endif">
                                {{ $merchant->status_label }}
                            </span>
                        </div>

                        <div><strong>تاريخ التسجيل:</strong>
                            {{ \Carbon\Carbon::parse($merchant->created_at)->format('Y-m-d') }}</div>
                        <div><strong>آخر تسجيل دخول:</strong>
                            {{ $merchant->last_login_at ? \Carbon\Carbon::parse($merchant->last_login_at)->format('Y-m-d H:i') : 'لم يسجل دخول' }}
                        </div>
                    </div>
                </div>

                <!-- 🏢 Company Info -->
                @if($merchant->companyinfo)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">معلومات المنشأة</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                            <div><strong>اسم المنشأة:</strong> {{ $merchant->companyinfo->company_name ?? '—' }}</div>
                            <div><strong>رقم المنشأة:</strong> {{ $merchant->companyinfo->establishment_number ?? '—' }}</div>
                            <div><strong>المدينة:</strong> {{ $merchant->companyinfo->city ?? '—' }}</div>
                            <div><strong>الحي:</strong> {{ $merchant->companyinfo->district ?? '—' }}</div>
                            <div><strong>اسم المدير:</strong> {{ $merchant->companyinfo->manager_name ?? '—' }}</div>
                            <div><strong>الهاتف 1:</strong> {{ $merchant->companyinfo->phone_1 ?? '—' }}</div>
                            <div><strong>الهاتف 2:</strong> {{ $merchant->companyinfo->phone_2 ?? '—' }}</div>
                            <div><strong>البريد الإلكتروني:</strong> {{ $merchant->companyinfo->company_email ?? '—' }}</div>

                            @if($merchant->companyinfo->commercial_record_pdf)
                                <div>
                                    <strong>السجل التجاري:</strong>
                                    <a href="{{ asset('storage/' . $merchant->companyinfo->commercial_record_pdf) }}"
                                        target="_blank" class="text-blue-600 hover:underline">📄 عرض</a>
                                </div>
                            @endif
                        </div>
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

                        <h2 class="text-xl font-bold text-gray-800">طلبات التاجر</h2>


                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-100 text-sm">
                            <thead class="bg-gray-100 text-gray-700 text-xs uppercase font-semibold">
                                <tr>
                                    <th class="px-3 py-2">#</th>
                                    <th class="px-3 py-2">رقم الطلب</th>
                                    <th class="px-3 py-2">اسم العميل</th>
                                    <th class="px-3 py-2">رقم العقد</th>
                                    <th class="px-3 py-2">المبلغ المطلوب</th>
                                    <th class="px-3 py-2">المبلغ المدفوع</th>
                                    <th class="px-3 py-2">المتابعات</th>
                                    <th class="px-3 py-2">التحصيلات</th>
                                    <th class="px-3 py-2">المحصلين</th>
                                    <th class="px-3 py-2">الحالة</th>
                                    <th class="px-3 py-2 text-center">الإجراءات</th>
                                </tr>
                            </thead>

                            <tbody id="tableBody">
                                @forelse ($complaints as $complaint)
                                    <tr onclick="window.location='{{ route('lawyer.complaints.show', $complaint->id) }}'"
                                        class="cursor-pointer hover:bg-gray-50 transition">

                                        <td class="px-3 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-3 py-2 font-semibold">#{{ $complaint->serial_number }}</td>
                                        <td class="px-3 py-2">{{ $complaint->client_name }}</td>
                                        <td class="px-3 py-2">{{ $complaint->contract_number }}</td>
                                        <td class="px-3 py-2 text-green-600 font-semibold">
                                            {{ number_format($complaint->amount_requested, 0) }} ر.س
                                        </td>
                                        <td class="px-3 py-2 text-yellow-600 font-semibold">
                                            {{ number_format($complaint->amount_paid, 0) }} ر.س
                                        </td>

                                        <!-- Followups -->
                                        <td class="px-3 py-2 text-center">
                                            <a href="{{ route('lawyer.complaints.followup', $complaint->id) }}"
                                                onclick="event.stopPropagation()" class=" hover:underline text-sm">
                                                المتابعات
                                            </a>
                                        </td>

                                        <!-- Collections -->
                                        <td class="px-3 py-2 text-center">
                                            <a href="{{ route('lawyer.complaints.collections', $complaint->id) }}"
                                                onclick="event.stopPropagation()" class=" hover:underline text-sm">
                                                التحصيلات
                                            </a>
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
                                                    class="text-blue-600 hover:underline text-sm">اختر المحصلين</button>
                                            @else
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($collectors as $collector)
                                                        <span
                                                            onclick="event.stopPropagation(); openCollectorModal({{ $complaint->id }})"
                                                            class="cursor-pointer px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs hover:bg-green-200 transition">
                                                            {{ $collector->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Status -->
                                        <td class="px-3 py-2 text-center">
                                            <button
                                                onclick="event.stopPropagation(); openStatusModal({{ $complaint->id }}, '{{ $complaint->status }}')"
                                                class="px-3 py-1 rounded-full text-xs font-semibold transition hover:opacity-80
                                                                                                                                    @if($complaint->status == 'pending') bg-yellow-100 text-yellow-700
                                                                                                                                    @elseif($complaint->status == 'in_progress') bg-blue-100 text-blue-700
                                                                                                                                    @elseif($complaint->status == 'completed') bg-green-100 text-green-700
                                                                                                                                    @elseif($complaint->status == 'cancelled') bg-red-100 text-red-700
                                                                                                                                    @else bg-gray-100 text-gray-700 @endif">
                                                {{ $complaint->status_label }}
                                            </button>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-3 py-2 text-center">
                                            <button onclick="event.stopPropagation(); confirmDelete({{ $complaint->id }})"
                                                class="text-red-600 hover:text-red-800" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="py-6 text-center text-gray-500">لا توجد طلبات لهذا التاجر.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
        </main>


    </div>

@endsection