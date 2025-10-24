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
            <!-- Main Content -->


            @include('dashboard.partials.errors')

            <div class="bg-white rounded-lg shadow-soft p-6">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-1xl font-bold text-green mb-4 md:mb-0">
                        المتابعات للقضية رقم #{{ $complaint->serial_number }}
                    </h2>
                </div>

                <!-- Timeline -->
                <div class="relative border-r-4  pr-6">
                    @forelse($complaint->followUps as $follow)
                        <div class="mb-4 relative">
                            <!-- الدائرة -->
                            <div
                                class="absolute -right-[17px] top-2 w-4 h-4 bg-green rounded-full border-2 border-white shadow">
                            </div>

                            <!-- محتوى المتابعة -->
                            <div class="bg-gray-50 rounded-lg shadow-sm p-4 md:p-2 transition hover:bg-gray-100">
                                <p class="text-black text-base leading-relaxed mb-2">
                                    {{ $follow->note }}
                                </p>
                                <div class="text-sm flex gap-4 text-gray-700">
                                    <div>
                                        <span class="text-red-600 font-semibold">بواسطة:</span>
                                        <span
                                            class="text-black font-semibold">{{ $follow->collector->name ?? 'غير معروف' }}</span>
                                    </div>
                                    <br>
                                    <div>
                                        <span class="text-red-600">تاريخ المتابعة:</span>
                                        <span class="text-black font-medium">{{ $follow->follow_date ?? '—' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-gray-500 font-medium">
                            لا توجد متابعات لهذه الشكوى حتى الآن.
                        </div>
                    @endforelse
                </div>

                <button id="addFollowUpBtn" class="btn btn-green hover-up text-sm font-semibold flex items-center gap-2">
                    <i class="fas fa-plus"></i> إضافة متابعة
                </button>
            </div>

            <!-- Modal لإضافة متابعة جديدة -->
            <div id="addFollowUpModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-strong w-full max-w-lg mx-4 p-6 relative">
                    <h3 class="text-xl font-bold text-green mb-4">إضافة متابعة جديدة</h3>

                    <form action="{{ route('collector.followups.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">

                        <div class="mb-4">
                            <label class="block mb-1 text-gray-700 font-semibold">وسيلة المتابعة</label>
                            <input type="text" name="method"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green"
                                placeholder="مثلاً: اتصال هاتفي">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 text-gray-700 font-semibold">تاريخ المتابعة</label>
                            <input type="date" name="follow_date"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green">
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1 text-gray-700 font-semibold">تفاصيل المتابعة</label>
                            <textarea name="note" rows="4"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green focus:border-green"
                                placeholder="اكتب تفاصيل المتابعة..."></textarea>
                        </div>

                        <div class="flex justify-end gap-3">
                            <button type="button" id="closeModalBtn" class="btn btn-yellow hover-up">إلغاء</button>
                            <button type="submit" class="btn prevent-double  btn-green hover-up">حفظ المتابعة</button>
                        </div>
                    </form>
                </div>
            </div>

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