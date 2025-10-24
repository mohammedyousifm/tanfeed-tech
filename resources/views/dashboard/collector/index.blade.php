@extends('dashboard.partials.app')
@section('title', 'لوحة تحكم')

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

            </div>
        </main>
    </div>

@endsection