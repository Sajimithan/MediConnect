<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    @if(Auth::user()->isDoctor())
                        Doctor Profile Settings 👨‍⚕️
                    @else
                        Profile Settings 👤
                    @endif
                </h2>
                <p class="text-gray-600 mt-1">
                    @if(Auth::user()->isDoctor())
                        Manage your professional profile and practice information
                    @else
                        Update your personal information and account settings
                    @endif
                </p>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">Last Updated</div>
                <div class="text-lg font-semibold text-gray-900">{{ Auth::user()->updated_at->format('M d, Y') }}</div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Profile Overview Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Profile Overview</h3>
                    <p class="text-gray-600 mt-1">Your current profile information</p>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-6">
                        <div class="w-20 h-20 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-indigo-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-semibold text-gray-900">{{ Auth::user()->name }}</h4>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                    {{ Auth::user()->role_name }}
                                </span>
                                @if(Auth::user()->isDoctor())
                                <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Medical Professional
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Member Since</div>
                            <div class="text-lg font-semibold text-gray-900">{{ Auth::user()->created_at->format('M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Profile Settings -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Basic Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Basic Information
                            </h3>
                            <p class="text-gray-600 mt-1">Update your personal details and contact information</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    @if(Auth::user()->isDoctor())
                    <!-- Professional Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Professional Information
                            </h3>
                            <p class="text-gray-600 mt-1">Manage your medical credentials and practice details</p>
                        </div>
                        <div class="p-6">
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="specialization" class="block text-sm font-medium text-gray-700">Medical Specialization</label>
                                        <select name="specialization" id="specialization" 
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="">Select Specialization</option>
                                            <option value="general" {{ Auth::user()->specialization === 'general' ? 'selected' : '' }}>General Practice</option>
                                            <option value="cardiology" {{ Auth::user()->specialization === 'cardiology' ? 'selected' : '' }}>Cardiology</option>
                                            <option value="dermatology" {{ Auth::user()->specialization === 'dermatology' ? 'selected' : '' }}>Dermatology</option>
                                            <option value="pediatrics" {{ Auth::user()->specialization === 'pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                                            <option value="orthopedics" {{ Auth::user()->specialization === 'orthopedics' ? 'selected' : '' }}>Orthopedics</option>
                                            <option value="neurology" {{ Auth::user()->specialization === 'neurology' ? 'selected' : '' }}>Neurology</option>
                                            <option value="psychiatry" {{ Auth::user()->specialization === 'psychiatry' ? 'selected' : '' }}>Psychiatry</option>
                                            <option value="surgery" {{ Auth::user()->specialization === 'surgery' ? 'selected' : '' }}>Surgery</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="license_number" class="block text-sm font-medium text-gray-700">Medical License Number</label>
                                        <input type="text" name="license_number" id="license_number" 
                                               value="{{ Auth::user()->license_number ?? '' }}" 
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                               placeholder="Enter your license number">
                                    </div>
                                    
                                    <div>
                                        <label for="years_experience" class="block text-sm font-medium text-gray-700">Years of Experience</label>
                                        <input type="number" name="years_experience" id="years_experience" 
                                               value="{{ Auth::user()->years_experience ?? '' }}" 
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                               placeholder="Years of practice">
                                    </div>
                                    
                                    <div>
                                        <label for="hospital_affiliation" class="block text-sm font-medium text-gray-700">Hospital Affiliation</label>
                                        <input type="text" name="hospital_affiliation" id="hospital_affiliation" 
                                               value="{{ Auth::user()->hospital_affiliation ?? '' }}" 
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                               placeholder="Hospital or clinic name">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="bio" class="block text-sm font-medium text-gray-700">Professional Bio</label>
                                    <textarea name="bio" id="bio" rows="4" 
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                              placeholder="Tell patients about your experience and approach to care...">{{ Auth::user()->bio ?? '' }}</textarea>
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                                        Update Professional Info
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    <!-- Contact Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Contact Information
                            </h3>
                            <p class="text-gray-600 mt-1">Update your contact details and address</p>
                        </div>
                        <div class="p-6">
                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                        <input type="tel" name="phone" id="phone" 
                                               value="{{ Auth::user()->phone ?? '' }}" 
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                               placeholder="+94 75 123 4567">
                                    </div>
                                    
                                    <div>
                                        <label for="emergency_contact" class="block text-sm font-medium text-gray-700">Emergency Contact</label>
                                        <input type="text" name="emergency_contact" id="emergency_contact" 
                                               value="{{ Auth::user()->emergency_contact ?? '' }}" 
                                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                               placeholder="Emergency contact name and number">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <textarea name="address" id="address" rows="3" 
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                              placeholder="Enter your full address...">{{ Auth::user()->address ?? '' }}</textarea>
                                </div>
                                
                                <div class="flex justify-end">
                                    <button type="submit" 
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                                        Update Contact Info
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Security Settings -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Security Settings
                            </h3>
                            <p class="text-gray-600 mt-1">Manage your password and account security</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Quick Stats -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Profile Stats</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Profile Completion</span>
                                    <span class="text-sm font-medium text-gray-900">85%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                                
                                @if(Auth::user()->isDoctor())
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Health Tips Created</span>
                                    <span class="text-sm font-medium text-gray-900">12</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Patients Helped</span>
                                    <span class="text-sm font-medium text-gray-900">24</span>
                                </div>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Last Login</span>
                                    <span class="text-sm font-medium text-gray-900">{{ Auth::user()->updated_at->format('M d') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    </svg>
                                    Back to Dashboard
                                </a>
                                
                                @if(Auth::user()->isDoctor())
                                <a href="{{ route('health-tips.create') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Create Health Tip
                                </a>
                                @endif
                                
                                <a href="{{ route('users.health-dashboard') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-50 rounded-lg transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Health Dashboard
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Account Management -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Account Management</h3>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
