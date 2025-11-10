<aside id="sidebar" class="sidebar fixed top-0 right-0 h-full w-64 bg-white z-50 overflow-y-auto">
    <!-- Logo Section -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div class="flex pt-1 items-center space-x-reverse">
                <img src="{{ asset('logo/hlol-logo.png') }}" loading="lazy" width="55" alt="logo">
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    @include('dashboard.partials.navigation')

    <!-- User Profile Section -->
    @include('dashboard.partials.user-profile')
</aside>