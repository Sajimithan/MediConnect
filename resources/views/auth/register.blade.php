<x-guest-layout>
    <!-- Welcome Message -->
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Create Your Account</h2>
        <p class="text-gray-600">Join HealthCare Pro and choose your role</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Role Selection -->
        <div>
            <x-input-label for="role" :value="__('Select Your Role')" class="text-gray-700 font-medium" />
            <select id="role" 
                    name="role" 
                    required 
                    class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                <option value="">Choose your role...</option>
                <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>👨‍⚕️ Doctor - Patient care & health tips management</option>
                <option value="nurse" {{ old('role') == 'nurse' ? 'selected' : '' }}>👩‍⚕️ Nurse - Patient care & limited admin access</option>
                <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>👤 Patient - Personal health management</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
            <p class="mt-2 text-sm text-gray-500">
                <strong>Note:</strong> Administrator accounts are created through secure internal processes.
            </p>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
            <x-text-input id="name" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" 
                         type="text" 
                         name="name" 
                         :value="old('name')" 
                         required 
                         autofocus 
                         autocomplete="name"
                         placeholder="Enter your full name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
            <x-text-input id="email" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" 
                         type="email" 
                         name="email" 
                         :value="old('email')" 
                         required 
                         autocomplete="username"
                         placeholder="Enter your email address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                         type="password"
                         name="password"
                         required 
                         autocomplete="new-password"
                         placeholder="Create a strong password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation" 
                         class="block mt-2 w-full px-4 py-3 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                         type="password"
                         name="password_confirmation" 
                         required 
                         autocomplete="new-password"
                         placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" 
                       name="terms" 
                       type="checkbox" 
                       required
                       class="w-4 h-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="text-gray-600">
                    I agree to the 
                    <a href="#" class="text-indigo-600 hover:text-indigo-500 font-medium">Terms of Service</a> 
                    and 
                    <a href="#" class="text-indigo-600 hover:text-indigo-500 font-medium">Privacy Policy</a>
                </label>
            </div>
        </div>

        <!-- Register Button -->
        <div class="pt-4">
            <x-primary-button class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-150 transform hover:scale-105 shadow-lg">
                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500 font-medium">
                    Sign in here
                </a>
            </p>
        </div>
    </form>

    <!-- Role Information -->
    <div class="mt-8 p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
        <h3 class="text-sm font-semibold text-indigo-800 mb-3">Role Information</h3>
        <div class="text-xs text-indigo-700 space-y-2">
            <div class="flex items-center">
                <span class="text-lg mr-2">👨‍⚕️</span>
                <div>
                    <strong>Doctor:</strong> Manage patients, create health tips, access medical records
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-lg mr-2">👩‍⚕️</span>
                <div>
                    <strong>Nurse:</strong> Patient care, health monitoring, limited administrative tasks
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-lg mr-2">👤</span>
                <div>
                    <strong>Patient:</strong> Personal health dashboard, health tips access, profile management
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
