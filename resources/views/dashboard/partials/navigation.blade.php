@if (Auth::user()->role === 'lawyer')
    <nav class="p-3">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('lawyer.dashboard') }}"
                    class="nav-link {{ request()->routeIs('lawyer.dashboard') ? 'active' : '' }}  flex items-center space-x-3 space-x-reverse p-2 rounded-md">
                    <i class="fas fa-home text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الرئيسية</span>
                </a>
            </li>

            <a href="{{ route('lawyer.complaints.index') }}"
                class="nav-link {{ request()->routeIs('lawyer.complaints.index') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                <i class="fas fa-clipboard-list text-[#1B7A75] text-lg w-5"></i>
                <span class="font-medium">الطلبات</span>
            </a>

            <a href="{{ route('lawyer.collectors.index') }}"
                class="nav-link {{ request()->routeIs('lawyer.collectors.index') ? 'active' : '' }}  flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                <i class="fas fa-user-tie text-[#1B7A75] text-lg w-5"></i>
                <span class="font-medium">المحصلين</span>
            </a>

            <a href="{{ route('lawyer.merchant.index') }}"
                class="nav-link {{ request()->routeIs('lawyer.merchant.index') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                <i class="fas fa-store text-[#1B7A75] text-lg w-5"></i>
                <span class="font-medium">التجار</span>
            </a>



            <li>
                <a href="{{ route('lawyer.payment.dates') }}"
                    class="nav-link {{ request()->routeIs('lawyer.payment.dates') ? 'active' : '' }} flex  items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-clock text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">مواعيد السداد</span>
                </a>
            </li>


            <li>
                <a href="{{ route('lawyer.complaints.neglectedcontracts') }}"
                    class="nav-link {{ request()->routeIs('lawyer.complaints.neglectedcontracts') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-exclamation-triangle text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">عقود مهملة</span>
                </a>
            </li>

            <li>
                <a href="{{ route('lawyer.complaints.cancelled') }}"
                    class="nav-link {{ request()->routeIs('lawyer.complaints.cancelled') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fa-solid fa-xmark text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الطلبات الملغية</span>
                </a>
            </li>

            <li>
                <a href="{{ route('lawyer.complaints.obtainedcontracts') }}"
                    class="nav-link {{ request()->routeIs('lawyer.complaints.obtainedcontracts') ? 'active' : '' }} flex  items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-hand-holding-usd text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">العقود المحصلة</span>
                </a>
            </li>


            <li>
                <a href="{{ route('lawyer.settings.notifications') }}"
                    class="nav-link {{ request()->routeIs('lawyer.settings.notifications') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-bell text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الإشعارات</span>
                    @if ($unreadCount > 0)
                        <span class="mr-auto bg-[#CF9411] text-white text-xs px-2 py-1 rounded-full">
                            {{ $unreadCount }}</span>
                    @endif
                </a>
            </li>

            <li>
                <a href="{{ route('lawyer.settings.index') }}"
                    class="nav-link {{ request()->routeIs('lawyer.settings.index') ? 'active' : '' }}  flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-cog text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الإعدادات</span>
                </a>
            </li>
        </ul>
    </nav>


@elseif (Auth::user()->role === 'collector')
    <nav class="p-3">
        <ul class="space-y-2">

            <li>
                <a href="{{ route('collector.dashboard') }}"
                    class="nav-link active flex items-center space-x-3 space-x-reverse p-2 rounded-md">
                    <i class="fas fa-home text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الرئيسية</span>
                </a>
            </li>

            <a href="{{ route('collector.complaints.index') }}"
                class="nav-link flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                <i class="fas fa-chart-bar text-[#1B7A75] text-lg w-5"></i>
                <span class="font-medium">الطلبات</span>
            </a>


            <li>
                <a href="#" class="nav-link flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-cog text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الإعدادات</span>
                </a>
            </li>

        </ul>
    </nav>


@elseif (Auth::user()->role === 'merchant')
    <nav class="p-3">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('merchant.dashboard') }}"
                    class="nav-link {{ request()->routeIs('merchant.dashboard') ? 'active' : '' }}  flex items-center space-x-3 space-x-reverse p-2 rounded-md">
                    <i class="fas fa-home text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الرئيسية</span>
                </a>
            </li>

            <a href="{{ route('merchant.complaints.index') }}"
                class="nav-link {{ request()->routeIs('merchant.complaints.index') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                <i class="fas fa-chart-bar text-[#1B7A75] text-lg w-5"></i>
                <span class="font-medium">الطلبات</span>
            </a>

            <li>
                <a href="#" class="nav-link  flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-box text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الدعم الفني</span>
                </a>
            </li>

            <li>
                <a href="{{ route('merchant.complaints.pending') }}"
                    class="nav-link {{ request()->routeIs('merchant.complaints.pending') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-exclamation-triangle text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الطلبات المعلقة</span>
                </a>
            </li>


            {{-- <li>
                <a href="{{ route('merchant.settings.notifications') }}"
                    class="nav-link {{ request()->routeIs('merchant.settings.notifications') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-bell text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الإشعارات</span>
                    @if ($unreadCount > 0)
                    <span class="mr-auto bg-[#CF9411] text-white text-xs px-2 py-1 rounded-full">
                        {{ $unreadCount }}</span>
                    @endif
                </a>
            </li> --}}


            <li>
                <a href="{{ route('merchant.settings.index') }}"
                    class="nav-link {{ request()->routeIs('merchant.settings.index') ? 'active' : '' }} flex items-center space-x-3 space-x-reverse p-2 rounded-md text-gray-700">
                    <i class="fas fa-cog text-[#1B7A75] text-lg w-5"></i>
                    <span class="font-medium">الإعدادات</span>
                </a>
            </li>
        </ul>
    </nav>
@endif
