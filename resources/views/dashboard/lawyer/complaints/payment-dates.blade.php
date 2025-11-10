@extends('dashboard.partials.app')
@section('title', 'تواريخ السداد')

@section('Content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">مواعيد السداد</h1>

    <div
        class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 bg-gray-50 p-2 rounded-lg shadow-sm border border-gray-200">

        {{-- 🔍 Search Form --}}
        <form method="GET" action="{{ route('lawyer.payment.dates') }}" class="w-full md:w-2/3">
            <div class="flex">
                <input type="search" name="search" value="{{ request('search') }}"
                    class="flex-grow rounded-s-lg border border-[#1B7A75] focus:ring-2 focus:ring-[#1B7A75]/40 focus:border-[#1B7A75] text-gray-800 px-4 py-2 text-sm placeholder:text-gray-500 outline-none"
                    placeholder="ابحث بارقم الطلب , رقم المتابعة..." aria-label="Search" id="exampleFormControlInput3" />

                <button type="submit"
                    class="bg-[#1B7A75] hover:bg-[#16615C] text-white rounded-e-lg px-6 py-2 text-sm font-medium transition duration-200 shadow-sm">
                    بحث
                </button>
            </div>
        </form>


        {{-- 🟢 Filter Buttons --}}
        <div class="flex gap-2">

        </div>

    </div>


    <!-- 📅 Table -->
    <div class="overflow-x-auto bg-white rounded-lg shadow border border-gray-200">
        <table class="min-w-full text-sm text-center">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-4 py-3">رقم الطلب</th>
                    <th class="px-4 py-3">رقم المتابعة</th>
                    <th class="px-4 py-3">اسم الشخص</th>
                    <th class="px-4 py-3">رقم الاتصال</th>
                    <th class="px-4 py-3">المحصّل</th>
                    <th class="px-4 py-3">تاريخ الاتصال</th>
                    <th class="px-4 py-3">تاريخ السداد</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @forelse ($FollowUps as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $item->complaint->serial_number }}</td>
                        <td class="px-4 py-3">{{ $item->serial_number }}</td>
                        <td class="px-4 py-3">{{ $item->called_person_name ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $item->call_number ?? '—' }}</td>
                        <td class="px-4 py-3">{{ optional($item->collector)->name ?? '—' }}</td>
                        <td class="px-4 py-3">
                            {{ $item->call_date ? \Carbon\Carbon::parse($item->call_date)->format('d/m/Y') : '—' }}
                        </td>
                        <td class="px-4 py-3 font-semibold text-[#1B7A75]">
                            {{ $item->payment_date ? \Carbon\Carbon::parse($item->payment_date)->format('d/m/Y h:i A') : '—' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-gray-500">لا توجد بيانات مطابقة</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $FollowUps->links('pagination::tailwind') }}
    </div>
@endsection