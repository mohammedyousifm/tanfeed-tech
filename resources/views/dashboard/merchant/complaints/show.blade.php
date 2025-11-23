@extends('dashboard.partials.app')
@section('title', 'تفاصيل الطلب')

@section('Content')

    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-1xl font-bold text-[#1B7A75]">
                تفاصيل الطلب رقم #{{ $complaint->serial_number }}
            </h2>
        </div>

        <!-- Complaint Info -->
        <section class="mb-10">
            <h3 class="text-lg font-semibold text-[#1B7A75] border-b-2 border-[#1B7A75]/10 pb-2 mb-4">
                🧾 معلومات الطلب
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm leading-6 text-gray-700">
                <div><strong>اسم العميل:</strong> {{ $complaint->client_name }}</div>
                <div><strong>الهوية الوطنية:</strong> {{ $complaint->client_national_id ?? '—' }}</div>
                <div><strong>رقم الجوال 1:</strong> {{ $complaint->phone_number1 }}</div>
                <div><strong>رقم الجوال 2:</strong> {{ $complaint->phone_number2 ?? '—' }}</div>
                <div><strong>مدينة العميل:</strong> {{ $complaint->client_city ?? '—' }}</div>
                <div><strong>الاسم التجاري:</strong> {{ $complaint->commercial_name }}</div>
                <div><strong>رقم السجل التجاري:</strong> {{ $complaint->commercial_record_number }}</div>
                <div><strong>رقم العقد:</strong> {{ $complaint->contract_number }}</div>
                <div><strong>الخدمة المطلوبة:</strong> {{ $complaint->service_requested_label    }}</div>
                <div><strong>المبلغ المطلوب:</strong> {{ number_format($complaint->amount_requested, 2) }} ر.س</div>
                <div><strong>المبلغ المدفوع:</strong> {{ number_format($complaint->amount_paid, 2) }} ر.س</div>
                <div><strong>المبلغ المتبقي:</strong> {{ number_format($complaint->amount_remaining, 2) }} ر.س</div>

                <div>
                    <strong>الحالة:</strong>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-medium
                                                                                                                                                    @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                                                                                                                                    @elseif($complaint->status === 'completed') bg-green-100 text-green-800
                                                                                                                                                    @elseif($complaint->status === 'cancelled') bg-red-100 text-red-700
                                                                                                                                                    @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800
                                                                                                                                                    @else bg-gray-100 text-gray-700 @endif">
                        {{ $complaint->status_label }}
                    </span>
                </div>

                <div><strong>تاريخ الإنشاء:</strong> {{ $complaint->created_at->format('Y-m-d') }}</div>
                <div><strong>آخر تحديث:</strong> {{ $complaint->updated_at->format('Y-m-d') }}</div>
            </div>
        </section>

        <!-- Attachments Section -->
        <section class="mb-10">
            <h3 class="text-lg font-semibold text-[#1B7A75] border-b-2 border-[#1B7A75]/10 pb-2 mb-4">
                📎 المرفقات
            </h3>

            @if($complaint->attachments->isNotEmpty())
                <ul class="space-y-2 text-sm">
                    @foreach($complaint->attachments as $attachment)
                        <li class="flex items-center gap-2">
                            <span>📄</span>
                            <a href="{{ asset('storage/' . $attachment->file_name) }}" target="_blank"
                                class="text-[#1B7A75] hover:text-[#16615C] underline">
                                {{ $attachment->display_name ?? 'عرض المرفق' }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <!-- No Attachments Yet -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mt-4 text-center text-gray-600">
                <p class="mb-4"> إضافة أي مرفقات.</p>

                <!-- Upload Form -->
                <form action="{{ route('merchant.complaints.attachments.store', $complaint->id) }}" method="POST"
                    enctype="multipart/form-data" class="text-right">
                    @csrf
                    <div id="attachmentsContainer" class="space-y-4">
                        <div class="attachment-item flex items-center gap-4 bg-white p-4 rounded-md border">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold mb-1">اسم المرفق</label>
                                <input type="text" name="attachment_names[]" required
                                    class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-[#1B7A75]"
                                    placeholder="مثلاً: مستند إضافي">
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm font-semibold mb-1">اختر الملف</label>
                                <input type="file" name="attachment_files[]" required
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                    class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-[#1B7A75]">
                            </div>
                            <button type="button" class="remove-attachment text-red-500 hover:text-red-700 mt-6">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Add More -->
                    <button type="button" id="addAttachment"
                        class="mt-4 bg-[#1B7A75] hover:bg-[#16615C] text-white px-4 py-2 rounded-md text-sm flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        إضافة مرفق آخر
                    </button>

                    <!-- Submit -->
                    <button type="submit"
                        class="mt-6 prevent-double bg-[#1B7A75] hover:bg-[#16615C] text-white px-6 py-2 rounded-md text-sm font-semibold">
                        حفظ المرفقات
                    </button>
                </form>
            </div>

        </section>



    </div>
@endsection
