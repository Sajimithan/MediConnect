<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    @if(Auth::user()->isDoctor())
                        Patient Care Dashboard 👨‍⚕️
                    @else
                        Health Dashboard 🏥
                    @endif
                </h2>
                <p class="text-gray-600 mt-1">
                    @if(Auth::user()->isDoctor())
                        Monitor and manage patient health information
                    @else
                        View and update your personal health information
                    @endif
                </p>
            </div>
            <div class="text-right">
                <div class="text-sm text-gray-500">Last Updated</div>
                <div class="text-lg font-semibold text-gray-900">{{ now()->format('M d, Y') }}</div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(Auth::user()->isDoctor())
            <!-- Doctor's Patient Care View -->
            
            <!-- Patient Overview Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Patients</p>
                            <p class="text-2xl font-semibold text-gray-900">24</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Healthy Patients</p>
                            <p class="text-2xl font-semibold text-gray-900">18</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Need Attention</p>
                            <p class="text-2xl font-semibold text-gray-900">6</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Today's Appts</p>
                            <p class="text-2xl font-semibold text-gray-900">5</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Patient Management Tools -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Patient Management Tools</h3>
                    <p class="text-gray-600 mt-1">Quick access to patient care features</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('patient-records.index') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Patient Records</p>
                                <p class="text-xs text-gray-500">View and manage patient records</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Health Monitoring</p>
                                <p class="text-xs text-gray-500">Track patient metrics</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Schedule</p>
                                <p class="text-xs text-gray-500">Manage appointments</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Reports</p>
                                <p class="text-xs text-gray-500">Generate health reports</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Alerts</p>
                                <p class="text-xs text-gray-500">Patient notifications</p>
                            </div>
                        </a>

                        <a href="#" class="flex items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Analytics</p>
                                <p class="text-xs text-gray-500">Health insights</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            @else
            <!-- Personal Health Dashboard for Patients/Nurses -->
            
            <!-- Personal Health Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Age</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ Auth::user()->age ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">BMI</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ Auth::user()->bmi ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Blood Type</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ Auth::user()->blood_type ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Last Checkup</p>
                            <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->last_checkup_date ? \Carbon\Carbon::parse(Auth::user()->last_checkup_date)->format('M d') : 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Health Information Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        @if(Auth::user()->isDoctor())
                            Update Patient Information
                        @else
                            Update Health Information
                        @endif
                    </h3>
                    <p class="text-gray-600 mt-1">
                        @if(Auth::user()->isDoctor())
                            Modify patient health records and care plans
                        @else
                            Keep your health information up to date
                        @endif
                    </p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('users.update-health') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                <input type="number" name="age" id="age" value="{{ Auth::user()->age }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select name="gender" id="gender" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ Auth::user()->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ Auth::user()->gender === 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ Auth::user()->gender === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                                <input type="number" name="height" id="height" value="{{ Auth::user()->height }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" step="0.1" name="weight" id="weight" value="{{ Auth::user()->weight }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="blood_type" class="block text-sm font-medium text-gray-700">Blood Type</label>
                                <select name="blood_type" id="blood_type" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select Blood Type</option>
                                    <option value="A+" {{ Auth::user()->blood_type === 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ Auth::user()->blood_type === 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ Auth::user()->blood_type === 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ Auth::user()->blood_type === 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ Auth::user()->blood_type === 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ Auth::user()->blood_type === 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ Auth::user()->blood_type === 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ Auth::user()->blood_type === 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="last_checkup_date" class="block text-sm font-medium text-gray-700">Last Checkup Date</label>
                                <input type="date" name="last_checkup_date" id="last_checkup_date" 
                                       value="{{ Auth::user()->last_checkup_date ? \Carbon\Carbon::parse(Auth::user()->last_checkup_date)->format('Y-m-d') : '' }}" 
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        
                        <div>
                            <label for="health_conditions" class="block text-sm font-medium text-gray-700">Health Conditions</label>
                            <textarea name="health_conditions" id="health_conditions" rows="3" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="List any health conditions, allergies, or medications...">{{ Auth::user()->health_conditions }}</textarea>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                                Update Health Information
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Health Tips Section -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Today's Health Tip</h3>
                    <p class="text-gray-600 mt-1">Stay informed with expert health advice</p>
                </div>
                <div class="p-6">
                    <div id="health-tip-container" class="text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600 mx-auto mb-4"></div>
                        <p class="text-gray-500">Loading health tip...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Load health tips when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadHealthTips();
        });

        function loadHealthTips() {
            fetch('/api/health-tips/random')
                .then(response => response.json())
                .then(tip => {
                    if (tip) {
                        displayHealthTip(tip);
                    }
                })
                .catch(error => {
                    console.error('Error loading health tip:', error);
                    document.getElementById('health-tip-container').innerHTML = 
                        '<div class="text-center text-gray-500">Unable to load health tips at this time.</div>';
                });
        }

        function displayHealthTip(tip) {
            const container = document.getElementById('health-tip-container');
            container.innerHTML = `
                <div class="text-left">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" viewBox="0 0 100 100" fill="currentColor">
                                <circle cx="50" cy="50" r="45" fill="currentColor" opacity="0.1"/>
                                <rect x="45" y="25" width="10" height="50" fill="currentColor" rx="2"/>
                                <rect x="25" y="45" width="50" height="10" fill="currentColor" rx="2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-900">${tip.title}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                ${tip.category}
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed">${tip.content}</p>
                    <div class="mt-4 text-sm text-gray-500">
                        <span class="font-medium">Priority:</span> ${tip.priority} | 
                        <span class="font-medium">Created:</span> ${new Date(tip.created_at).toLocaleDateString()}
                    </div>
                </div>
            `;
        }
    </script>
</x-app-layout>
