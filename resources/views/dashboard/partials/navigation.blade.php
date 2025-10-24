@if (Auth::user()->role === 'lawyer')
    <nav class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('lawyer.dashboard') }}"
                    class="nav-link active flex items-center space-x-3 space-x-reverse p-3 rounded-md">
                    <i class="fas fa-home text-green text-lg w-5"></i>
                    <span class="font-medium">الرئيسية</span>
                </a>
            </li>

            <a href="{{ route('lawyer.complaints.index') }}"
                class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                <i class="fas fa-chart-bar text-green text-lg w-5"></i>
                <span class="font-medium">الفواتير</span>
            </a>

            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-users text-green text-lg w-5"></i>
                    <span class="font-medium">العقود والاتفاقيات</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-shopping-cart text-green text-lg w-5"></i>
                    <span class="font-medium">التحصيل</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-bell text-green text-lg w-5"></i>
                    <span class="font-medium">الإشعارات</span>
                    <span class="mr-auto bg-green text-white text-xs px-2 py-1 rounded-full">3</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-cog text-green text-lg w-5"></i>
                    <span class="font-medium">الإعدادات</span>
                </a>
            </li>
        </ul>
    </nav>


@elseif (Auth::user()->role === 'collector')
    <nav class="p-4">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('collector.dashboard') }}"
                    class="nav-link active flex items-center space-x-3 space-x-reverse p-3 rounded-md">
                    <i class="fas fa-home text-green text-lg w-5"></i>
                    <span class="font-medium">الرئيسية</span>
                </a>
            </li>

            <a href="{{ route('collector.complaints.index') }}"
                class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                <i class="fas fa-chart-bar text-green text-lg w-5"></i>
                <span class="font-medium">الطلبات</span>
            </a>


            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-bell text-green text-lg w-5"></i>
                    <span class="font-medium">الإشعارات</span>
                    <span class="mr-auto bg-green text-white text-xs px-2 py-1 rounded-full">3</span>
                </a>
            </li>

            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-cog text-green text-lg w-5"></i>
                    <span class="font-medium">الإعدادات</span>
                </a>
            </li>

        </ul>
    </nav>


@elseif (Auth::user()->role === 'merchant')
    <nav class="p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('merchant.dashboard') }}"
                    class="nav-link active flex items-center space-x-3 space-x-reverse p-3 rounded-md">
                    <i class="fas fa-home text-green text-lg w-5"></i>
                    <span class="font-medium">الرئيسية</span>
                </a>
            </li>

            <a href="{{ route('merchant.complaints.index') }}"
                class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                <i class="fas fa-chart-bar text-green text-lg w-5"></i>
                <span class="font-medium">الفواتير</span>
            </a>

            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-users text-green text-lg w-5"></i>
                    <span class="font-medium">العقود والاتفاقيات</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-box text-green text-lg w-5"></i>
                    <span class="font-medium">الدعم الفني</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-shopping-cart text-green text-lg w-5"></i>
                    <span class="font-medium">التحصيل</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-bell text-green text-lg w-5"></i>
                    <span class="font-medium">الإشعارات</span>
                    <span class="mr-auto bg-green text-white text-xs px-2 py-1 rounded-full">3</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-3 rounded-md text-gray-700">
                    <i class="fas fa-cog text-green text-lg w-5"></i>
                    <span class="font-medium">الإعدادات</span>
                </a>
            </li>
        </ul>
    </nav>
@endif