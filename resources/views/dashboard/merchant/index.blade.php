@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم التاجر')

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
        <main class="p-4 lg:p-6">
            <!-- Stats Cards -->
            @include('dashboard.partials.stats-cards')

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Recent Activity -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-clock text-green ml-2"></i>
                        النشاط الأخير
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4 space-x-reverse pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 bg-green bg-opacity-10 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-plus text-green"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-sm">مستخدم جديد انضم</p>
                                <p class="text-xs text-gray-500">منذ 5 دقائق</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 space-x-reverse pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 bg-yellow bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-yellow"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-sm">طلب جديد #1234</p>
                                <p class="text-xs text-gray-500">منذ 15 دقيقة</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 space-x-reverse pb-4 border-b border-gray-100">
                            <div class="w-10 h-10 bg-green bg-opacity-10 rounded-full flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-green"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-sm">دفعة جديدة $450</p>
                                <p class="text-xs text-gray-500">منذ 30 دقيقة</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold mb-4 flex items-center">
                        <i class="fas fa-star text-green ml-2"></i>
                        المنتجات الأكثر مبيعاً
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <div class="w-12 h-12 bg-gray-200 rounded-md"></div>
                                <div>
                                    <p class="font-medium text-sm">منتج رقم 1</p>
                                    <p class="text-xs text-gray-500">543 عملية بيع</p>
                                </div>
                            </div>
                            <span class="text-green font-semibold">$12,450</span>
                        </div>
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <div class="w-12 h-12 bg-gray-200 rounded-md"></div>
                                <div>
                                    <p class="font-medium text-sm">منتج رقم 2</p>
                                    <p class="text-xs text-gray-500">432 عملية بيع</p>
                                </div>
                            </div>
                            <span class="text-green font-semibold">$9,870</span>
                        </div>
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3 space-x-reverse">
                                <div class="w-12 h-12 bg-gray-200 rounded-md"></div>
                                <div>
                                    <p class="font-medium text-sm">منتج رقم 3</p>
                                    <p class="text-xs text-gray-500">321 عملية بيع</p>
                                </div>
                            </div>
                            <span class="text-green font-semibold">$7,654</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection