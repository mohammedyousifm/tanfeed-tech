@extends('dashboard.partials.app')
@section('title', 'تنفيذ تك - الطلبات المعلقة')

@section('Content')


    <!-- Page Title -->
    <h1 class="text-1xl font-bold text-gray-800 mb-4">الطلبات المعلقة</h1>

    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4 bg-gray-50 p-2 rounded-lg shadow-sm border border-gray-200">
        {{-- 🔍 Search Form --}}
        <form method="GET" action="{{ route('lawyer.complaints.index') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="f-12 flex-grow rounded-s-lg border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث بالاسم، رقم الطلب أو رقم العقد..." aria-label="Search"
                    id="exampleFormControlInput3" />

                <button type="submit"
                    class="f-12 bg-[#1B7A75] hover:bg-[#16615C] text-white rounded-e-lg px-6 py-2 font-medium transition duration-200 shadow-sm">
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
                        <th class="f-11">رقم الطلب</th>
                        <th class="f-11">اسم العميل</th>
                        <th class="f-11">رقم العقد</th>
                        <th class="f-11">المبلغ المتبقي</th>
                        <th class="f-11">تاريخ الطلب</th>
                        <th class="f-11">الحالة</th>
                        <th class="f-11">التحصيلات</th>
                        <th class="f-11">المتابعات</th>
                        <th class="f-11">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                    @forelse ($complaints as $complaint)
                        <tr>
                            <td class="f-11">{{ $complaint->serial_number }}#</td>
                            <td class="font-semibold f-11">{{ $complaint->client_name }}</td>
                            <td class="f-11">{{ $complaint->contract_number }}</td>
                            <td class="font-semibold f-11">{{  number_format($complaint->amount_remaining, 0) }} ر.س
                            </td>

                            <!-- created at  -->
                            <td class="px-3 py-2 f-11 font-semibold text-yellow-600">
                                {{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d')  }}
                            </td>

                            <td><span class="status-badge f-11 status-active">{{$complaint->status_label }}</span>
                            </td>

                            <td class="f-11"><a
                                    href="{{ route('merchant.complaints.collections', $complaint->id) }}">التحصيلات</a></span>
                            </td>

                            <td class="f-11">
                                <a href="{{ route('merchant.complaints.followup', $complaint->id) }}">المتابعات</a>
                            </td>


                            <td class="px-3 flex py-2 mt-2 text-center">
                                <div class="flex justify-center gap-2">
                                    <form action="" method="POST"
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




    </div>

    <!-- Pagination -->
    @if ($complaints->hasPages())
        <div class="p-4 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">

            <!-- Info -->
            <p class="f-11 text-gray-600">
                عرض {{ $complaints->firstItem() }} - {{ $complaints->lastItem() }} من أصل {{ $complaints->total() }}
                شكاوى
            </p>

            <!-- Pagination Buttons -->
            <div class="flex gap-2 items-center">

                {{-- Previous Page --}}
                @if ($complaints->onFirstPage())
                    <button class="px-2 py-2 rounded-md border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @else
                    <a href="{{ $complaints->previousPageUrl() }}"
                        class="px-2 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
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
                        class="px-2 py-2 rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @else
                    <button class="px-2 py-2 rounded-md border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                @endif
            </div>
        </div>
    @endif


@endsection