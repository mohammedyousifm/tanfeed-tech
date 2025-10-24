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
            </div>


        </main>
    </div>

@endsection