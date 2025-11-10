@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم ')

@section('Content')


    <div class="bg-white rounded-lg shadow-soft p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-1xl font-bold text-[#CF9411] mb-4 md:mb-0">
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
                        <th class="px-4 py-3 border-b"> التحويل ( مرفق)</th>
                        <th class="px-4 py-3 border-b">نسبة تنفيذ تك</th>
                        <th class="px-4 py-3 border-b">اسم المحصل</th>
                        <th class="px-4 py-3 border-b"> تحويل النسبة من التاجر
                        </th>
                        <th class="px-4 py-3 border-b">نسبة المحصل</th>
                        <th class="px-4 py-3 border-b"> تحويل نسبة المحصل
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($complaint->collections as $collection)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-bold text-[#CF9411] whitespace-nowrap">
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
                                <span class="text-[#CF9411] font-semibold">{{ $collection->collector->name }}</span>
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
                                        <button type="button" onclick="openTanfeedModal({{ $collection->id }})"
                                            class="text-green-600 hover:underline flex items-center gap-1">
                                            <i class="fas fa-upload"></i>
                                            <span>رفع إيصال تنفيذ تك</span>
                                        </button>
                                    @endif
                                </div>
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($collection->collector_fee)
                                    {{ number_format($collection->collector_fee, 0) }} ريال
                                @else
                                    <span class="text-gray-400">لا يوجد</span>
                                @endif
                            </td>

                            {{-- collector_fee_receipt --}}
                            <td class="px-4 py-3">
                                <div class="flex flex-col gap-1">
                                    @if($collection->collector_fee_receipt)
                                        <a href="{{ asset('storage/' . $collection->collector_fee_receipt) }}" target="_blank"
                                            class="text-yellow-600 hover:underline flex items-center gap-1">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                            <span>عرض إيصال المحصل</span>
                                        </a>
                                    @else
                                        <button type="button" onclick="openTanfeedModal({{ $collection->id }})"
                                            class="text-green-600 hover:underline flex items-center gap-1">
                                            <i class="fas fa-upload"></i>
                                            <span>رفع إيصال المحصل</span>
                                        </button>
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

        <button id="addCollectionBtn"
            class="btn mt-3 bg-[#1B7A75] hover:bg-[#16615C] text-white hover-up text-sm font-semibold flex items-center gap-2">
            <i class="fas fa-plus"></i> إضافة تحصيل
        </button>

    </div>


    <!-- Modal  -->
    @include('dashboard.lawyer.models.add-collection')


    <!-- Tanfeed Receipt Upload Modal -->
    <div id="tanfeedModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <h2 class="text-lg font-semibold mb-4 text-gray-800">رفع إيصال تنفيذ تك</h2>

            <form id="tanfeedForm" action="{{ route('lawyer.collections.uploadTanfeed') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="collection_id" id="tanfeedCollectionId">

                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">اختيار الملف</label>
                    <input type="file" name="tanfeed_receipt" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeTanfeedModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        إلغاء
                    </button>
                    <button type="submit" class="px-4 py-2 btn-green text-white rounded hover:bg-green-700">
                        رفع
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- JS -->
    <script>
        // addCollection
        document.getElementById('addCollectionBtn').addEventListener('click', () => {
            document.getElementById('addCollectionModal').classList.remove('hidden');
            document.getElementById('addCollectionModal').classList.add('flex');
        });

        document.getElementById('closeCollectionModalBtn').addEventListener('click', () => {
            document.getElementById('addCollectionModal').classList.add('hidden');
            document.getElementById('addCollectionModal').classList.remove('flex');
        });

        // tanfeedModal
        function openTanfeedModal(collectionId) {
            document.getElementById('tanfeedModal').classList.remove('hidden');
            document.getElementById('tanfeedCollectionId').value = collectionId;
        }

        function closeTanfeedModal() {
            document.getElementById('tanfeedModal').classList.add('hidden');
        }
    </script>
    </main>

    </div>

@endsection