<x-guest-layout>
    <!-- Welcome Message -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Set New Password</h2>
        <p class="text-gray-600">Create a new secure password for your account</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
            <x-text-input id="email" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" 
                         type="email" 
                         name="email" 
                         :value="old('email', $request->email)" 
                         required 
                         autofocus 
                         autocomplete="username"
                         placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" 
                         type="password" 
                         name="password" 
                         required 
                         autocomplete="new-password"
                         placeholder="Enter your new password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                         type="password"
                         name="password_confirmation" 
                         required 
                         autocomplete="new-password"
                         placeholder="Confirm your new password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Password Requirements -->
        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <h3 class="text-sm font-semibold text-yellow-800 mb-2">Password Requirements</h3>
            <ul class="text-xs text-yellow-700 space-y-1">
                <li>• At least 8 characters long</li>
                <li>• Include uppercase and lowercase letters</li>
                <li>• Include at least one number</li>
                <li>• Include at least one special character</li>
            </ul>
        </div>

        <!-- Reset Button -->
        <div class="pt-4">
            <x-primary-button class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-150 transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Back to Login -->
    <div class="mt-8 text-center">
        <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
            ← Back to Login
        </a>
    </div>
</x-guest-layout>

