@extends('auth.app')
@section('title', 'نسيت كلمة المرور - تنفيذ تك')
@section('contain')

    <section class="py-12 md:py-16 min-h-screen flex items-center">
        <div class="container">
            <div class="max-w-md mx-auto">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope text-green ml-2"></i>
                            البريد الإلكتروني
                        </label>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-key text-green ml-2"></i>
                            كلمة المرور الجديدة
                        </label>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-key text-green ml-2"></i>
                            تأكيد كلمة المرور
                        </label>

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <x-primary-button>
                            {{ __('إعادة تعيين كلمة المرور') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection