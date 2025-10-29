@if (Auth::user()->role === 'lawyer')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">

        <!-- عدد العملاء -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">عدد العملاء</h3>
            <p class="text-2xl font-bold text-black">{{ $merchantCount }}</p>
        </div>

        <!-- جميع الشكاوى -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-folder-open text-gray-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">إجمالي الطلبات</h3>
            <p class="text-2xl font-bold text-black">{{ $totalComplaints }}</p>
        </div>



        <!-- طلب جديد -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-file-circle-plus text-green-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">طلب جديد</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['pending'] }}</p>
        </div>

        <!-- طلب معلق -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">طلب معلق</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['suspended'] }}</p>
        </div>

        <!-- جاري العمل -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">جاري العمل</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['in_progress'] }}</p>
        </div>

        <!-- مكتمل -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">الطلبات المكتملة</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['completed'] }}</p>
        </div>

    </div>


@elseif (Auth::user()->role === 'collector')


@elseif (Auth::user()->role === 'merchant')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-6">

        <!-- طلب جديد -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-file-circle-plus text-green-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">طلب جديد</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['pending'] }}</p>
        </div>

        <!-- طلب معلق -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">طلب معلق</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['suspended'] }}</p>
        </div>

        <!-- جاري العمل -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">جاري العمل</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['in_progress'] }}</p>
        </div>

        <!-- مكتمل -->
        <div class="stat-card bg-white p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-md flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm mb-1">الطلبات المكتملة</h3>
            <p class="text-2xl font-bold text-black">{{ $stats['completed'] }}</p>
        </div>

    </div>
@endif
