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
        <main class="p-4 lg:p-2">

            <!-- Page Title -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6">قائمة المحصلين</h1>

            <!-- Search Form -->
            <form method="GET" action="{{ route('lawyer.collectors.index') }}" class="mb-6">
                <div class="max-w-md w-full">
                    <div class="relative flex  items-center">
                        <!-- Search Input -->
                        <input type="search" name="search" value="{{ request('search') }}"
                            placeholder="ابحث بالاسم، رقم المحصل أو البريد الإلكتروني..."
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

            <div class="mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="javascript:void(0)" onclick="openCollectorModal()"
                        class="btn-primary p-2 rounded-md font-semibold flex items-center justify-center">
                        <i class="fas fa-plus ml-2"></i>
                        إضافة محصل جديد
                    </a>

                </div>
            </div>


            <!-- Table Container -->
            <div class="table-container">
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم المحصل</th>
                                <th>اسم المحصل</th>
                                <th>بريد الإلكتروني</th>
                                <th>حالة الحساب</th>
                                <th>تاريخ الإنشاء</th>
                                <th>آخر تسجيل دخول</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collectors as $collector)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>#{{ $collector->client_number }}</td>
                                                    <td>{{ $collector->name }}</td>
                                                    <td class="font-semibold">{{ $collector->email }}</td>

                                                    <td>
                                                        <button class="status-badge px-3 py-1 rounded-full text-sm font-semibold transition hover:opacity-80
                                                                                                                        @if($collector->status == 'pending')
                                                                                                                            bg-yellow-100 text-yellow-700
                                                                                                                        @elseif($collector->status == 'suspended')
                                                                                                                            bg-blue-100 text-blue-700
                                                                                                                        @elseif($collector->status == 'active')
                                                                                                                            bg-green-100 text-green-700
                                                                                                                        @else
                                                                                                                            bg-gray-100 text-gray-700
                                                                                                                        @endif"
                                                            onclick="openCollectorStatusModal({{ $collector->id }}, '{{ $collector->status }}')"
                                                            title="تغيير الحالة">
                                                            {{ $collector->status_label }}
                                                        </button>
                                                    </td>

                                                    <td>{{ \Carbon\Carbon::parse($collector->created_at)->format('Y-m-d') }}</td>
                                                    <td>
                                                        {{ $collector->last_login_at
                                ? \Carbon\Carbon::parse($collector->last_login_at)->format('Y-m-d')
                                : 'لم يسجل دخول' }}
                                                    </td>


                                                    <td>
                                                        <div class="flex gap-2">
                                                            <button class="action-btn view" title="عرض"
                                                                onclick="viewClient({{ $collector->id }})">
                                                                <i class="fas fa-eye"></i>
                                                            </button>

                                                            <button class="action-btn edit" title="تعديل">
                                                                <i class="fas fa-edit"></i>
                                                            </button>

                                                            <button class="action-btn delete" title="حذف"
                                                                onclick="confirmDelete({{ $collector->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-6">
                                        <div class="text-gray-600 text-sm">
                                            <i class="fas fa-info-circle text-yellow me-2"></i>
                                            لا توجد نتائج مطابقة للبحث.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal لإضافة محصل جديد -->
            <div id="addCollectorModal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4 p-6 relative">
                    <h3 class="text-xl font-bold text-green mb-4">إضافة محصل جديد</h3>

                    <form method="POST" action="{{ route('lawyer.collectors.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-1 font-semibold text-gray-700">اسم المحصل</label>
                            <input type="text" name="name" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-semibold text-gray-700">البريد الإلكتروني</label>
                            <input type="email" name="email" required
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 font-semibold text-gray-700">كلمة المرور</label>
                            <input type="password" name="password" required minlength="6"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" onclick="closeCollectorModal()"
                                class="btn btn-yellow hover-up">إلغاء</button>
                            <button type="submit" class="btn btn-green hover-up">حفظ</button>
                        </div>
                    </form>
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

            <script>

                function openCollectorModal() {
                    document.getElementById('addCollectorModal').classList.remove('hidden');
                    document.getElementById('addCollectorModal').classList.add('flex');
                }

                function closeCollectorModal() {
                    document.getElementById('addCollectorModal').classList.add('hidden');
                    document.getElementById('addCollectorModal').classList.remove('flex');
                }

                function openCollectorStatusModal(id, currentStatus) {
                    const modal = document.getElementById('statusModal');
                    const form = document.getElementById('statusForm');

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    document.getElementById('merchantId').value = id;
                    document.getElementById('statusSelect').value = currentStatus;
                    form.action = `/lawyer/collectors/${id}/status`;
                }

                /**
                 * Close merchant status modal
                 */
                function closeStatusModal() {
                    const modal = document.getElementById('statusModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }
            </script>
        </main>
    </div>

@endsection