<div class="absolute bottom-0 w-full p-4 border-t border-gray-200 bg-white">
    <div class="flex items-center space-x-3 space-x-reverse">
        <img src="https://ui-avatars.com/api/?name=أحمد+محمد&background=1d9942&color=fff&bold=true" alt="User"
            class="w-10 h-10 rounded-full">
        <div class="flex-1">
            <p class="font-semibold text-sm">{{ $user->name }}</p>
            <p class="text-xs text-gray-500">مدير النظام</p>
        </div>
        <a href="{{ route('logout') }}" class="text-gray-400 hover:text-green">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</div>