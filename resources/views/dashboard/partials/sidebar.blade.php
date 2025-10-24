<aside id="sidebar" class="sidebar fixed top-0 right-0 h-full w-64 bg-white z-50 overflow-y-auto">
    <!-- Logo Section -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3 space-x-reverse">
                <div class="w-10 h-10 bg-green rounded-md flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-green">{{ $user->name }}</h1>
                    <p class="text-xs text-gray-500">نظام الإدارة</p>
                </div>
            </div>
            <button id="closeSidebar" class="lg:hidden text-gray-600 hover:text-green">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Menu -->
    @include('dashboard.partials.navigation')

    <!-- User Profile Section -->
    @include('dashboard.partials.user-profile')
</aside>