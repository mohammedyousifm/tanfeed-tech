@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم ')

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
            <!-- Page Title -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6">قائمة التجار</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('lawyer.merchant.index') }}" class="mb-6">
                <div class="max-w-md w-full">
                    <div class="relative flex  items-center">
                        <!-- Search Input -->
                        <input type="search" name="search" value="{{ request('search') }}"
                            placeholder="ابحث بالاسم، رقم التاجر أو البريد الإلكتروني..."
                            class="block w-full p-2 ps-10 pe-24 text-sm border border-green rounded bg-white text-gray-800 transition shadow-soft" />

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
                                <th>#</th>
                                <th>رقم التاجر</th>
                                <th>اسم التاجر</th>
                                <th>ايميل التاجر</th>
                                <th>اسم الشركة</th>
                                <th>حالة الحساب</th>
                                <th>تاريخ التسجيل</th>
                                <th>آخر تسجيل دخول</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($merchants as $merchant)
                                                <tr onclick="window.location='{{ route('lawyer.merchant.show', $merchant->id) }}'"
                                                    class="cursor-pointer hover:bg-gray-50 transition">
                                                    <!-- # -->
                                                    <td class="px-3 py-2 text-center text-gray-700">{{ $loop->iteration }}</td>

                                                    <!-- Client Number -->
                                                    <td class="px-3 py-2 font-semibold text-gray-800">#{{ $merchant->client_number }}</td>

                                                    <!-- Name -->
                                                    <td class="px-3 py-2 text-gray-700">{{ $merchant->name }}</td>

                                                    <!-- Email -->
                                                    <td class="px-3 py-2 font-semibold text-gray-700">{{ $merchant->email }}</td>

                                                    <!-- Company Name -->
                                                    <td class="px-3 py-2">{{ $merchant->companyinfo->company_name ?? '—' }}</td>

                                                    <!-- Status -->
                                                    <td class="px-3 py-2 text-center">
                                                        <button
                                                            onclick="event.stopPropagation(); openMerchantStatusModal({{ $merchant->id }}, '{{ $merchant->status }}')"
                                                            title="تغيير الحالة" class="px-3 py-1 rounded-full text-xs font-semibold transition hover:opacity-80
                                                @if($merchant->status == 'pending')
                                                    bg-yellow-100 text-yellow-700
                                                @elseif($merchant->status == 'suspended')
                                                    bg-blue-100 text-blue-700
                                                @elseif($merchant->status == 'active')
                                                    bg-green-100 text-green-700
                                                @else
                                                    bg-gray-100 text-gray-700
                                                @endif">
                                                            {{ $merchant->status_label }}
                                                        </button>
                                                    </td>

                                                    <!-- Created At -->
                                                    <td class="px-3 py-2 text-gray-600">
                                                        {{ \Carbon\Carbon::parse($merchant->created_at)->format('Y-m-d') }}
                                                    </td>

                                                    <!-- Last Login -->
                                                    <td class="px-3 py-2 text-gray-600">
                                                        {{ $merchant->last_login_at
                                ? \Carbon\Carbon::parse($merchant->last_login_at)->format('Y-m-d')
                                : 'لم يسجل دخول' }}
                                                    </td>

                                                    <!-- Actions -->
                                                    <td class="px-3 py-2 text-center">
                                                        <div class="flex justify-center gap-2">
                                                            <button onclick="event.stopPropagation(); confirmDelete({{ $merchant->id }})"
                                                                class="action-btn delete text-red-600 hover:text-red-800" title="حذف">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-6">
                                        <div class="text-gray-600 text-sm flex justify-center items-center gap-2">
                                            <i class="fas fa-info-circle text-yellow-500"></i>
                                            لا توجد نتائج مطابقة للبحث.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>



            <!-- Change Merchant Status Modal -->
            <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-strong w-full max-w-md mx-4 p-6 relative">
                    <h3 class="text-xl font-bold text-green mb-4">تغيير حالة التاجر</h3>

                    <form id="statusForm" method="POST" action="">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="merchant_id" id="merchantId" />

                        <!-- Status Select -->
                        <div class="mb-4">
                            <label class="block mb-1 text-gray-700 font-semibold">اختر الحالة الجديدة</label>
                            <select name="status" id="statusSelect"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                                <option value="active">تفعيل</option>
                                <option value="suspended">تعليق</option>
                                <option value="pending">قيد المراجعة</option>
                            </select>
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex justify-end gap-3">
                            <button type="button" onclick="closeStatusModal()" class="btn btn-yellow hover-up">
                                إلغاء
                            </button>
                            <button type="submit" class="btn btn-green hover-up">
                                حفظ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- JavaScript -->
        <script>
            /**
             * Open merchant status modal
             * @param {number} id - Merchant ID
             * @param {string} currentStatus - Current merchant status
             */
            function openMerchantStatusModal(id, currentStatus) {
                const modal = document.getElementById('statusModal');
                const form = document.getElementById('statusForm');

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                document.getElementById('merchantId').value = id;
                document.getElementById('statusSelect').value = currentStatus;
                form.action = `/lawyer/merchant/${id}/status`;
            }

            /**
             * Close merchant status modal
             */
            function closeStatusModal() {
                const modal = document.getElementById('statusModal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }


            /**
             * View client details
             * @param {number} id - Client ID
             */
            function viewClient(id) {
                // Add your view client logic here
                console.log('Viewing client:', id);
            }

            /**
             * Confirm delete action
             * @param {number} id - Merchant ID
             */
            function confirmDelete(id) {
                if (confirm('هل أنت متأكد من حذف هذا التاجر؟')) {
                    // Add your delete logic here
                    console.log('Deleting merchant:', id);
                }
            }

            // Close modals when clicking outside
            document.addEventListener('click', function (event) {
                const statusModal = document.getElementById('statusModal');

                if (event.target === statusModal) {
                    closeStatusModal();
                }
                if (event.target === collectorModal) {
                    closeCollectorModal();
                }
            });
        </script>
    </div>

@endsection
