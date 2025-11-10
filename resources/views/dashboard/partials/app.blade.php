<!DOCTYPE html>
<html dir="rtl">

@include('dashboard.partials.head')

<body>


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

            @include('dashboard.partials.errors')

            @yield('Content')

        </main>
    </div>
    @include('dashboard.partials.footer')
</body>

</html>