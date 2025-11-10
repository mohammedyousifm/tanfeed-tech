@extends('dashboard.partials.app')
@section('title', 'الإشعارات')

@section('Content')
    <div class="container  px-2 py-2 max-w-4xl">
        <!-- Header -->
        <div class="mb-6">
            <h4 class="text-2xl font-bold text-gray-800 mb-2">الإشعارات</h4>
            <div class="h-1 w-20 bg-gradient-to-r from-[#1B7A75] to-[#CF9411] rounded-full"></div>
        </div>

        <!-- Notifications List -->
        <div class="space-y-3">
            @forelse($notifications as $notification)
                <div
                    class="group bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-300 border-r-4 {{ $notification->is_read ? 'border-gray-200' : 'border-[#CF9411]' }}">
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <!-- Icon and Title -->
                                <div class="flex items-center gap-3 mb-2">
                                    @if(!$notification->is_read)
                                        <span class="flex-shrink-0 w-2 h-2 bg-[#CF9411] rounded-full animate-pulse"></span>
                                    @endif
                                    <h5 class="font-semibold {{ $notification->is_read ? 'text-gray-700' : 'text-[#1B7A75]' }}">
                                        {{ $notification->title }}
                                    </h5>
                                </div>

                                <!-- Message -->
                                <p class="text-gray-600 f-14 leading-relaxed mb-3 pr-5">
                                    {{ $notification->message }}
                                </p>

                                <!-- Timestamp -->
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            @if(!$notification->is_read)
                                <span class="flex-shrink-0 px-3 py-1 text-xs font-medium text-white bg-[#CF9411] rounded-full">
                                    جديد
                                </span>
                            @endif


                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 mb-4 rounded-full bg-gradient-to-br from-[#1B7A75]/10 to-[#CF9411]/10">
                        <svg class="w-10 h-10 text-[#1B7A75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h5 class="text-xl font-semibold text-gray-700 mb-2">لا توجد إشعارات</h5>
                    <p class="text-gray-500">لم يتم استلام أي إشعارات حتى الآن</p>
                </div>
            @endforelse

            {{-- ✅ Only one script after the loop --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    setTimeout(() => {
                        fetch("{{ route('notifications.markAllRead') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({})
                        })
                            .then(response => response.json())
                            .then(data => {
                                console.log('✅ Notifications marked as read:', data);

                                document.querySelectorAll('[data-notification-new]').forEach(el => el.remove());
                            })
                            .catch(error => console.error('Error:', error));
                    });
                });
            </script>
        </div>
    </div>
@endsection