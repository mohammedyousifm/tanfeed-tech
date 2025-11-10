@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم ')

@section('Content')

    <!-- Page Header -->
    <h1 class="text-1xl font-bold text-gray-800 mb-6">قائمة التجار</h1>

    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200">
        {{-- 🔍 Search Form --}}
        <form method="GET" action="{{ route('lawyer.merchant.index') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="flex-grow rounded-s-lg border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث بالاسم، رقم التاجر أو البريد الإلكتروني..." aria-label="Search"
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
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="f-11">رقم التاجر</th>
                        <th class="f-11">اسم التاجر</th>
                        <th class="f-11">مدينة التاجر</th>
                        <th class="f-11">ايميل التاجر</th>
                        <th class="f-11">اسم الشركة</th>
                        <th class="f-11">حالة الحساب</th>
                        <th class="f-11">تاريخ التسجيل</th>
                        <th class="f-11">آخر تسجيل دخول</th>
                        <th class="f-11">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($merchants as $merchant)
                                <tr onclick="window.location='{{ route('lawyer.merchant.show', $merchant->id) }}'"
                                    class="cursor-pointer hover:bg-gray-50 transition">

                                    <!-- Client Number -->
                                    <td class="px-3 py-2 f-11 font-semibold text-gray-800">{{ $merchant->client_number }}#</td>

                                    <!-- Name -->
                                    <td class="px-3 py-2 f-11 text-gray-700">{{ $merchant->name }}</td>

                                    <td class="px-3 py-2 f-11 text-gray-700">{{ $merchant->companyinfo->city ?? '--' }}</td>

                                    <!-- Email -->
                                    <td class="px-3 py-2 f-11 font-semibold text-gray-700">{{ $merchant->email }}</td>

                                    <!-- Company Name -->
                                    <td class="px-3 py-2 f-11">{{ $merchant->companyinfo->company_name ?? '—' }}</td>

                                    <!-- Status -->
                                    <td class="px-3 py-2 f-11 text-center">
                                        <button
                                            onclick="event.stopPropagation(); openMerchantStatusModal({{ $merchant->id }}, '{{ $merchant->status }}')"
                                            title="تغيير الحالة"
                                            class="px-3 py-1 rounded-full text-xs font-semibold transition hover:opacity-80
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
                                    <td class="px-3 f-11 py-2 text-gray-600">
                                        {{ \Carbon\Carbon::parse($merchant->created_at)->format('Y-m-d') }}
                                    </td>

                                    <!-- Last Login -->
                                    <td class="px-3 f-11 py-2 text-gray-600">
                                        {{ $merchant->last_login_at
                        ? \Carbon\Carbon::parse($merchant->last_login_at)->format('Y-m-d')
                        : 'لم يسجل دخول' }}
                                    </td>

                                    <!-- Actions  -->
                                    <td class="px-3 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <form action="{{ route('lawyer.merchants.destroy', $merchant->id) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا التاجر؟');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" onclick="event.stopPropagation();"
                                                    class="text-red-600 hover:text-red-800" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

    <!-- Pagination -->
    @if ($merchants->hasPages())
        <div class="p-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">

            <!-- Info -->
            <p class="f-11 text-gray-600">
                عرض {{ $merchants->firstItem() }} - {{ $merchants->lastItem() }} من أصل {{ $merchants->total() }}
                التجار
            </p>

            <!-- Pagination Buttons -->
            <div class="flex gap-2 items-center">

                {{-- Previous Page --}}
                @if ($merchants->onFirstPage())
                    <button class="px-2 py-1 rounded-md border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @else
                    <a href="{{ $merchants->previousPageUrl() }}"
                        class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($merchants->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $merchants->currentPage())
                        <button
                            class="px-2 py-1 rounded-md bg-[#1B7A75] hover:bg-[#16615C] text-white text-white font-semibold">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}"
                            class="px-2 py-1 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($merchants->hasMorePages())
                    <a href="{{ $merchants->nextPageUrl() }}"
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
    @include('dashboard.lawyer.models.merchant-status')


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