<header class="header bg-white sticky top-0 z-30">
    <div class="flex items-center justify-between p-4 lg:p-4">
        <div class="flex items-center space-x-4 space-x-reverse">
            <button id="toggleSidebar" class="text-gray-600 hover:text-green">
                <i class="fas fa-bars text-2xl"></i>
            </button>
            <div class="hidden md:block">
                <h2 class="f-12 font-bold text-black">مرحباً بك، {{ Auth::user()->name }}</h2>
            </div>
        </div>

        <div class="flex items-center space-x-4 space-x-reverse">
            <!-- Search Bar -->
            <div class="hidden md:flex items-center bg-gray-100 rounded-md px-2 ">
                <i class="fas fa-search text-gray-400 ml-2"></i>
                <input type="text" placeholder="البحث..."
                    class="bg-transparent f-12 border-none outline-none text-sm w-64">
            </div>

            <!-- Notification Icon -->
            <button class="relative text-gray-600 hover:text-green">
                <i class="fas fa-bell text-xl"></i>
                @if ($unreadCount > 0)
                    <span
                        class="absolute -top-1 -right-1 bg-[#CF9411] text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                        {{ $unreadCount }}</span>
                @endif

            </button>

            <!-- User Avatar -->
            <div class="hidden  p-1 sm:block">
                <a href="{{ route($user->role . '.settings.index') }}"><i class="fa-solid f-25 fa-circle-user"></i></a>
            </div>
        </div>
    </div>
</header>

<style>
    #toggleSidebar {
        display: none;
    }

    @media screen and (max-width: 1024px) {
        #toggleSidebar {
            display: block;
        }

    }
</style>