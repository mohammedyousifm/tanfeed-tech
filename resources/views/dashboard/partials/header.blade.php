<header class="header bg-white sticky top-0 z-30">
    <div class="flex items-center justify-between p-4 lg:p-4">
        <div class="flex items-center space-x-4 space-x-reverse">
            <button id="toggleSidebar" class="text-gray-600 hover:text-green">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <div class="hidden md:block">
                <h2 class="text-sm font-bold text-black">مرحباً بك، {{ $user->name }}</h2>

            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <!-- Search Bar -->
            <div class="hidden md:flex items-center bg-gray-100 rounded-md px-2 ">
                <i class="fas fa-search text-gray-400 ml-2"></i>
                <input type="text" placeholder="البحث..." class="bg-transparent border-none outline-none text-sm w-64">
            </div>

            <!-- Notification Icon -->
            <button class="relative text-gray-600 hover:text-green">
                <i class="fas fa-bell text-xl"></i>
                <span
                    class="absolute -top-1 -right-1 bg-green text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">3</span>
            </button>

            <!-- User Avatar -->
            <div class="hidden sm:block">
                <img src="https://ui-avatars.com/api/?name=أحمد+محمد&background=1d9942&color=fff&bold=true" alt="User"
                    class="w-10 h-10 rounded-full cursor-pointer hover:ring-2 hover:ring-green">
            </div>
        </div>
    </div>
</header>