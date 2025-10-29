@extends('dashboard.partials.app')
@section('title', 'تفاصيل الطلب')

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
        <main class="p-4 lg:p-8 bg-gray-50 min-h-screen">
            <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-6 border border-gray-100">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        تفاصيل الطلب رقم #{{ $complaint->serial_number }}
                    </h2>
                    <button onclick="openPhoneModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        تعديل أرقام الجوال
                    </button>
                </div>

                <!-- Complaint Info -->
                <section class="mb-10">
                    <h3 class="text-lg font-semibold text-green-700 border-b border-green-100 pb-2 mb-4">
                        🧾 معلومات الطلب
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm leading-6">
                        <div><strong>اسم العميل:</strong> {{ $complaint->client_name }}</div>
                        <div><strong>الهوية الوطنية:</strong> {{ $complaint->client_national_id }}</div>
                        <div><strong>رقم الجوال 1:</strong> {{ $complaint->phone_number1 }}</div>
                        <div><strong>رقم الجوال 2:</strong> {{ $complaint->phone_number2 ?? '—' }}</div>
                        <div><strong>الاسم التجاري:</strong> {{ $complaint->commercial_name }}</div>
                        <div><strong>رقم السجل التجاري:</strong> {{ $complaint->commercial_record_number }}</div>
                        <div><strong>رقم العقد:</strong> {{ $complaint->contract_number }}</div>
                        <div><strong>الخدمة المطلوبة:</strong> {{ $complaint->service_requested }}</div>
                        <div><strong>المبلغ المطلوب:</strong> {{ number_format($complaint->amount_requested, 2) }} ر.س</div>
                        <div><strong>المبلغ المدفوع:</strong> {{ number_format($complaint->amount_paid, 2) }} ر.س</div>
                        <div><strong>المبلغ المتبقي:</strong> {{ number_format($complaint->amount_remaining, 2) }} ر.س</div>
                        <div>
                            <strong>الحالة:</strong>
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                                            @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
                                                            @elseif($complaint->status === 'completed') bg-green-100 text-green-800
                                                             @elseif($complaint->status === 'completed') bg-red-100 text-green-800
                                                            @elseif($complaint->status === 'in_progress') bg-blue-100 text-blue-800
                                                            @else bg-gray-100 text-gray-700 @endif">
                                {{$complaint->status_label}}
                            </span>
                        </div>
                        <div><strong>تاريخ الإنشاء:</strong>
                            {{ \Carbon\Carbon::parse($complaint->created_at)->format('Y-m-d') }}</div>
                        <div><strong>آخر تحديث:</strong>
                            {{ \Carbon\Carbon::parse($complaint->updated_at)->format('Y-m-d') }}</div>
                    </div>
                </section>

                <!-- Attachments -->
                @if(!empty($complaint->contract_attachments))
                    <section class="mb-10">
                        <h3 class="text-lg font-semibold text-green-700 border-b border-green-100 pb-2 mb-4">
                            📎 المرفقات
                        </h3>
                        @php $attachments = json_decode($complaint->contract_attachments, true); @endphp
                        <ul class="space-y-2 text-sm">
                            @foreach($attachments as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 underline flex items-center gap-1">
                                        <span>📄</span> عرض المرفق
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                <!-- Merchant Info -->
                <section>
                    <h3 class="text-lg font-semibold text-green-700 border-b border-green-100 pb-2 mb-4">
                        🏪 معلومات التاجر
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm leading-6">
                        <div><strong>رقم التاجر:</strong> {{ $merchant->client_number ?? '—' }}</div>
                        <div><strong>اسم التاجر:</strong> {{ $merchant->name }}</div>
                        <div><strong>البريد الإلكتروني:</strong> {{ $merchant->email }}</div>
                        <div><strong>رقم الجوال 1:</strong> {{ $merchant->companyinfo->phone_1 ?? '—' }}</div>
                        <div><strong>رقم الجوال 2:</strong> {{ $merchant->companyinfo->phone_2 ?? '—' }}</div>
                        <div><strong>تاريخ التسجيل:</strong>
                            {{ \Carbon\Carbon::parse($merchant->created_at)->format('Y-m-d') }}</div>
                        <div><strong>آخر تسجيل دخول:</strong>
                            {{ $merchant->last_login_at ? \Carbon\Carbon::parse($merchant->last_login_at)->format('Y-m-d') : '—' }}
                        </div>
                    </div>
                </section>
            </div>

            <!-- Phone Update Modal -->
            <div id="phoneModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center">
                        تعديل أرقام الجوال للطلب #{{ $complaint->serial_number }}
                    </h3>

                    <form action="" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">رقم الجوال 1</label>
                            <input type="text" name="phone_number1" value="{{ $complaint->phone_number1 }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">رقم الجوال 2</label>
                            <input type="text" name="phone_number2" value="{{ $complaint->phone_number2 }}"
                                class="w-full border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 text-sm">
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <button type="button" onclick="closePhoneModal()"
                                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm">
                                إلغاء
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">
                                حفظ التعديلات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- Modal Scripts -->
        <script>
            function openPhoneModal() {
                document.getElementById('phoneModal').classList.remove('hidden');
            }
            function closePhoneModal() {
                document.getElementById('phoneModal').classList.add('hidden');
            }
        </script>
    </div>

@endsection
