@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم ')

@section('Content')



    <div class="bg-white rounded-lg shadow-soft p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-1xl font-bold text-[#CF9411] mb-4 md:mb-0">
                المتابعات للقضية رقم #{{ $complaint->serial_number }}
            </h2>

                    <button id="addFollowUpBtn"
            class="btn bg-[#1B7A75] mt-3 hover:bg-[#16615C] text-white hover-up text-sm font-semibold flex items-center gap-2">
            <i class="fas fa-plus"></i> إضافة متابعة
        </button>
        </div>

        <!-- Timeline -->
        <div class="space-y-8">
            @forelse($followUps as $follow)
                <div class="relative border border-gray-400 rounded-md shadow bg-white overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gray-100 border-b border-gray-300 px-4 py-2 flex justify-between items-center">
                        <h3 class="font-bold text-[#1B7A75] f-12">رقم المتابعة:
                            <td class="border border-gray-400 px-2 py-1">{{ $follow->serial_number ?? '—' }}</td>
                        </h3>
                        <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    </div>

                    <!-- Table -->
                    <table class="w-full text-sm text-right border-collapse">
                        <tbody>
                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">رقم المتصل</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->call_number ?? 'لا يوجد' }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">تاريخ الاتصال</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->call_date ?? 'لا يوجد' }}</td>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">وقت الاتصال</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->call_time ?? 'لا يوجد' }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">اسم المتصل عليه</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->called_person_name ?? 'لا يوجد' }}</td>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">صفته</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->called_person_role ?? 'لا يوجد' }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">موعد سداد</td>
                                <td class="border border-gray-400 px-2 py-1">
                                    @if($follow->payment_commitment === 1)
                                        ✅ نعم
                                    @elseif($follow->payment_commitment === 0)
                                        ❎ لا
                                    @else — @endif
                                </td>
                                @if($follow->payment_commitment === 1)
                                    <td class="border border-gray-400 px-2 py-1 font-semibold">تاريخ الموعد</td>
                                    <td class="border border-gray-400 px-2 py-1">{{ $follow->payment_date ?? 'لا يوجد' }}</td>
                                @endif
                            </tr>

                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">اسم المحصل</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->collector->name  }}</td>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">تعليق المكالمة</td>
                                <td class="border border-gray-400 px-2 py-1">{{ $follow->note ?? 'لا يوجد' }}</td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold text-red-600">ملاحظة من المحامي</td>
                                <td class="border border-gray-400 px-2 py-1 text-red-600">
                                    {{ $follow->lawyer_comment ?? 'لا يوجد' }}
                                </td>
                            </tr>

                            <tr>
                                <td class="border border-gray-400 px-2 py-1 font-semibold">اعتماد المحامي</td>
                                <td class="border border-gray-400 px-2 py-1" colspan="3">
                                    @if($follow->lawyer_approved === 1)
                                        ✅ نعم
                                    @elseif($follow->lawyer_approved === 0)
                                        ❎ لا
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            @empty
                <div class="text-center py-10 text-gray-500 font-medium">
                    لا توجد متابعات معتمدة لهذه الشكوى حتى الآن.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal  -->
    @include('dashboard.lawyer.models.add-followup')

    <!-- JS -->
    <script>
        document.getElementById('addFollowUpBtn').addEventListener('click', () => {
            document.getElementById('addFollowUpModal').classList.remove('hidden');
            document.getElementById('addFollowUpModal').classList.add('flex');
        });

        document.getElementById('closeModalBtn').addEventListener('click', () => {
            document.getElementById('addFollowUpModal').classList.add('hidden');
            document.getElementById('addFollowUpModal').classList.remove('flex');
        });
    </script>

    </main>
    </div>

@endsection
