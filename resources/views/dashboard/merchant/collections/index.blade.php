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
            <div class="bg-white rounded-lg shadow-soft p-6">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-1xl font-bold text-green mb-4 md:mb-0">
                        التحصيلات للقضية رقم #{{ $complaint->serial_number }}
                    </h2>
                </div>

                <!-- Collections List -->
                <div class="overflow-x-auto rounded-lg shadow-sm bg-white">
                    <table class="min-w-full text-sm text-right border border-gray-200">
                        <thead class="bg-gray-100 text-gray-800 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-4 py-3 border-b">رقم التحصيل</th>
                                <th class="px-4 py-3 border-b">تاريخ التحصيل</th>
                                <th class="px-4 py-3 border-b">المبلغ المتحصل</th>
                                <th class="px-4 py-3 border-b">صورة التحويل ( مرفق)</th>
                                <th class="px-4 py-3 border-b">نسبة تنفيذ تك</th>
                                <th class="px-4 py-3 border-b">اسم المحصل</th>
                                <th class="px-4 py-3 border-b">صورة تحويل النسبة من قبل التاجر
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse($complaint->collections as $collection)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-bold text-green whitespace-nowrap">
                                        #{{ $collection->id }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $collection->collection_date }}
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ number_format($collection->amount, 0) }} ريال
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex flex-col gap-1">
                                            @if($collection->collection_receipt)
                                                <a href="{{ asset('storage/' . $collection->collection_receipt) }}" target="_blank"
                                                    class="text-green hover:underline flex items-center gap-1">
                                                    <i class="fas fa-receipt"></i>
                                                    <span>إيصال العميل</span>
                                                </a>
                                            @else
                                                <span>لا يوجد</span>
                                            @endif
                                        </div>
                                    </td>



                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if($collection->tanfeed_fee)
                                            {{ number_format($collection->tanfeed_fee, 0) }} ريال
                                        @else
                                            <span class="text-gray-400">لا يوجد</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="text-green font-semibold">{{ $collection->collector->name }}</span>
                                    </td>

                                    {{-- tanfeed_receipt --}}
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col gap-1">
                                            @if($collection->tanfeed_receipt)
                                                <a href="{{ asset('storage/' . $collection->tanfeed_receipt) }}" target="_blank"
                                                    class="text-yellow-600 hover:underline flex items-center gap-1">
                                                    <i class="fas fa-file-invoice-dollar"></i>
                                                    <span>عرض إيصال تنفيذ تك</span>
                                                </a>
                                            @else
                                                <span>لا يوجد</span>
                                            @endif
                                        </div>
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-500 font-medium">
                                        لا توجد تحصيلات لهذه الشكوى حتى الآن.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </main>

    </div>

@endsection