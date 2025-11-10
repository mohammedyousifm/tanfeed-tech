@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم ')

@section('Content')


    <!-- Page Header -->
    <h1 class="text-1xl font-bold text-gray-800 mb-6">قائمة المحصلين</h1>
    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
        {{-- 🔍 Search Form --}}
        <form method="GET" action="{{ route('lawyer.collectors.index') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="flex-grow rounded-s-lg border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث بالاسم، رقم المحصل أو البريد الإلكتروني..." aria-label="Search"
                    id="exampleFormControlInput3" />

                <button type="submit"
                    class="bg-[#1B7A75] hover:bg-[#16615C] text-white rounded-e-lg px-6 py-2 text-sm font-medium transition duration-200 shadow-sm">
                    بحث
                </button>
            </div>
        </form>

        {{-- 📤 Export Button --}}
        <a href="javascript:void(0)" onclick="openCollectorModal()"
            class="inline-flex items-center justify-center bg-[#1B7A75] hover:bg-[#16615C] text-white rounded-md px-5 py-2 text-sm font-medium transition duration-200 shadow-sm w-full md:w-auto text-center">

            <i class="fa-solid fa-plus ms-2 text-white/80"></i>
            إضافة محصل جديد
        </a>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="f-11">رقم المحصل</th>
                        <th class="f-11">اسم المحصل</th>
                        <th class="f-11">بريد الإلكتروني</th>
                        <th class="f-11">حالة الحساب</th>
                        <th class="f-11">تاريخ الإنشاء</th>
                        <th class="f-11">آخر تسجيل دخول</th>
                        <th class="f-11">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($collectors as $collector)
                                <tr>
                                    <td class="f-11">{{ $loop->iteration }}</td>

                                    <td class="f-11">#{{ $collector->client_number }}</td>
                                    <td class="f-11">{{ $collector->name }}</td>
                                    <td class="font-semibold f-11">{{ $collector->email }}</td>
                                    {{-- status --}}
                                    <td>
                                        <button
                                            class="status-badge px-3 py-1 f-11 rounded-full text-sm font-semibold transition hover:opacity-80
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

                                    <td class="f-11">{{ \Carbon\Carbon::parse($collector->created_at)->format('Y-m-d') }}</td>

                                    {{-- last_login_at --}}
                                    <td class="f-11">
                                        {{ $collector->last_login_at
                        ? \Carbon\Carbon::parse($collector->last_login_at)->format('Y-m-d')
                        : 'لم يسجل دخول' }}
                                    </td>

                                    <td>
                                        <div class="flex gap-2 justify-center">
                                            <form action="{{ route('lawyer.collectors.destroy', $collector->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا المحصل؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-[#ef4444] hover:text-red-700" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

    <!-- Pagination -->
    @if ($collectors->hasPages())
        <div class="p-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">

            <!-- Info -->
            <p class="f-11 text-gray-600">
                عرض {{ $collectors->firstItem() }} - {{ $collectors->lastItem() }} من أصل {{ $collectors->total() }}
                المحصلين
            </p>

            <!-- Pagination Buttons -->
            <div class="flex gap-2 items-center">

                {{-- Previous Page --}}
                @if ($collectors->onFirstPage())
                    <button class="px-2 py-1 rounded-md border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @else
                    <a href="{{ $collectors->previousPageUrl() }}"
                        class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($collectors->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $collectors->currentPage())
                        <button class="px-2 py-1 rounded-md bg-[#1B7A75] text-white font-semibold">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}"
                            class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($collectors->hasMorePages())
                    <a href="{{ $collectors->nextPageUrl() }}"
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

    {{-- Models --}}
    @include('dashboard.lawyer.models.add-collector')

    @include('dashboard.lawyer.models.collector-status')


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
