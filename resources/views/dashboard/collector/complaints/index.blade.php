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

            <!-- Action Buttons & Search -->
            <div class="mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <h1>صفحه الطلبات</h1>
            </div>

            <!-- Table Container -->
            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الطلب</th>
                                <th>اسم التاجر</th>
                                <th>اسم العميل</th>
                                <th>رقم العقد</th>
                                <th>الخدمة المطلوبة</th>
                                <th>المبلغ المطلوب</th>
                                <th>المبلغ المتبقي</th>
                                <th>الحالة</th>
                                <th>المتابعات</th>
                                <th>التحصيلات</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

                            @foreach ($complaints as $complaint)
                                <tr onclick="window.location='{{ route('collector.complaints.show', $complaint->id) }}'"
                                    class="cursor-pointer hover:bg-gray-50 transition">
                                    <!-- ID -->
                                    <td class="px-3 py-2 text-center text-gray-700">{{ $loop->iteration }}</td>
                                    <td>{{ $complaint->serial_number }}</td>
                                    <td class="px-3 py-2 text-gray-600">{{ $complaint->user->name }}</td>
                                    <td class="font-semibold">{{ $complaint->client_name }}</td>
                                    <td>{{ $complaint->contract_number }}</td>
                                    <td>{{ $complaint->service_requested }}</td>
                                    <td class="font-semibold text-green">{{   number_format($complaint->amount_requested, 0) }}
                                        ر.س
                                    </td>
                                    <td class="font-semibold text-yellow">{{  number_format($complaint->amount_paid, 0) }} ر.س
                                    </td>
                                    <td>
                                        <button
                                            class="status-badge status-active px-3 py-1 rounded-full text-sm font-semibold
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


                                    <td><a href="{{ route('collector.complaints.followup', $complaint->id) }}">المتابعات</a>
                                    </td>
                                    <td><a href="{{ route('collector.complaints.collections', $complaint->id) }}">التحصيلات</a>
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
    .header {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(10px);
    }

    .btn-primary {
        background-color: var(--color-green);
        color: var(--color-white);
        transition: var(--transition);
        font-size: 13px;
    }

    .btn-primary:hover {
        background-color: #166f33;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(29, 153, 66, 0.3);
    }

    .btn-secondary {
        background-color: var(--color-white);
        color: var(--color-black);
        border: 2px solid var(--color-green);
        transition: var(--transition);
        font-size: 13px;
    }

    .btn-secondary:hover {
        background-color: var(--color-green);
        color: var(--color-white);
    }

    .table-container {
        background-color: var(--color-white);
        border-radius: var(--radius-md);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .data-table thead {
        background-color: var(--color-green);
        color: var(--color-white);
    }

    .data-table thead th {
        padding: .5rem;
        font-weight: 600;
        text-align: right;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .data-table tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: var(--transition);
    }

    .data-table tbody tr:hover {
        background-color: rgba(29, 153, 66, 0.05);
    }

    .data-table tbody td {
        padding: 1rem;
        font-size: 0.875rem;
        color: var(--color-black);
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-sm);
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-active {
        background-color: rgba(29, 153, 66, 0.1);
        color: var(--color-green);
    }

    .status-pending {
        background-color: rgba(226, 211, 146, 0.2);
        color: #c9a800;
    }

    .status-completed {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .action-btn {
        padding: 0.5rem;
        border-radius: var(--radius-sm);
        transition: var(--transition);
        cursor: pointer;
        border: none;
        background: transparent;
    }

    .action-btn:hover {
        transform: scale(1.1);
    }

    .action-btn.view:hover {
        color: #3b82f6;
    }

    .action-btn.edit:hover {
        color: var(--color-green);
    }

    .action-btn.delete:hover {
        color: #ef4444;
    }

    .search-input {
        transition: var(--transition);
        border: 1px solid #e5e7eb;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--color-green);
        box-shadow: 0 0 0 3px rgba(29, 153, 66, 0.1);
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background-color: var(--color-white);
        border-radius: var(--radius-md);
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .data-table {
            font-size: 0.75rem;
        }

        .data-table thead th,
        .data-table tbody td {
            padding: 0.75rem 0.5rem;
        }
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
