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
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ route('merchant.complaints.create') }}"
                        class="btn-primary p-2 rounded-md font-semibold flex items-center justify-center">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة طلب جديد
                    </a>
                    <button class="btn-secondary px-4 py-2 rounded-md font-semibold flex items-center justify-center">
                        <i class="fas fa-file-excel ml-2"></i>
                        رفع ملف Excel
                    </button>
                </div>
            </div>

            <!-- Table Container -->
            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>رقم الطلب</th>
                                <th>اسم العميل</th>
                                <th>رقم العقد</th>
                                <th>الخدمة المطلوبة</th>
                                <th>المبلغ المطلوب</th>
                                <th>المبلغ المتبقي</th>
                                <th>الحالة</th>
                                <th>المتابعات</th>
                                <th>التحصيلات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

                            @foreach ($complaints as $complaint)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $complaint->serial_number }}#</td>
                                    <td class="font-semibold">{{ $complaint->client_name }}</td>
                                    <td>{{ $complaint->contract_number }}</td>
                                    <td>{{ $complaint->service_requested }}</td>
                                    <td class="font-semibold text-green">{{   number_format($complaint->amount_requested, 0) }}
                                        ر.س
                                    </td>
                                    <td class="font-semibold text-yellow">{{  number_format($complaint->amount_paid, 0) }} ر.س
                                    </td>
                                    <td><span class="status-badge status-active">{{$complaint->status_label }}</span>
                                    </td>

                                    <td><a
                                            href="{{ route('merchant.complaints.collections', $complaint->id) }}">التحصيلات</a></span>
                                    </td>

                                    <td>
                                        <a href="{{ route('merchant.complaints.followup', $complaint->id) }}">المتابعات</a>
                                    </td>

                                    <td>
                                        <div class="flex gap-2">
                                            <button class="action-btn edit" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="action-btn delete" title="حذف" onclick="confirmDelete(1)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody> </table>
                </div>

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

    <!-- View Client Modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-black">تفاصيل العميل</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6" id="modalContent">
                <!-- Content will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="p-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">تأكيد الحذف</h3>
                    <p class="text-gray-600 mb-6">هل أنت متأكد من حذف هذا العميل؟ لا يمكن التراجع عن هذا الإجراء.</p>
                    <div class="flex gap-3 justify-center">
                        <button onclick="closeDeleteModal()"
                            class="px-6 py-2 border-2 border-gray-300 rounded-md hover:bg-gray-100">
                            إلغاء
                        </button>
                        <button onclick="deleteClient()"
                            class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                            حذف
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
