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
                            <p class="text-sm font-medium text-gray-600">Total Patients</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::where('role', 'patient')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Medical Records</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\PatientRecord::where('doctor_id', Auth::id())->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Active Cases</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\PatientRecord::where('doctor_id', Auth::id())->where('status', 'active')->count() }}</p>
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
                            <p class="text-sm font-medium text-gray-600">Today's Visits</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\PatientRecord::where('doctor_id', Auth::id())->whereDate('visit_date', today())->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    <p class="text-gray-600 mt-1">Common patient care tasks</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('patient-records.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">New Record</p>
                                <p class="text-xs text-gray-500">Create patient record</p>
                            </div>
                        </a>

                        <a href="{{ route('patient-records.index') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">All Records</p>
                                <p class="text-xs text-gray-500">View all records</p>
                            </div>
                        </a>

                        <a href="{{ route('health-tips.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">Health Tip</p>
                                <p class="text-xs text-gray-500">Create health advice</p>
                            </div>
                        </a>

                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">User Management</p>
                                <p class="text-xs text-gray-500">Manage all users</p>
                            </div>
                        </a>
                        @else
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition-colors">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">My Profile</p>
                                <p class="text-xs text-gray-500">Update profile info</p>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Recent Patient Records -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Patient Records</h3>
                            <p class="text-gray-600 mt-1">Latest medical records and visits</p>
                        </div>
                        <a href="{{ route('patient-records.index') }}" 
                           class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                            View All →
                        </a>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Visit Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Complaint</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $recentRecords = \App\Models\PatientRecord::with(['patient'])
                                    ->where('doctor_id', Auth::id())
                                    ->orderBy('visit_date', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            
                            @forelse($recentRecords as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-medium text-indigo-600">{{ substr($record->patient->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $record->patient->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $record->visit_date->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($record->visit_type === 'emergency') bg-red-100 text-red-800
                                        @elseif($record->visit_type === 'consultation') bg-blue-100 text-blue-800
                                        @elseif($record->visit_type === 'follow_up') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $record->visit_type)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs truncate">
                                        {{ $record->chief_complaint ?? 'No complaint recorded' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($record->status === 'completed') bg-green-100 text-green-800
                                        @elseif($record->status === 'active') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($record->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('patient-records.show', $record->id) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">View</a>
                                        <a href="{{ route('patient-records.edit', $record->id) }}" 
                                           class="text-green-600 hover:text-green-900">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No patient records yet</h3>
                                        <p class="mt-1 text-sm text-gray-500">Start by creating your first patient record.</p>
                                        <div class="mt-6">
                                            <a href="{{ route('patient-records.create') }}" 
                                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                                Create First Record
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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

            @if(!Auth::user()->isDoctor())
            <!-- Health Information Form for Patients/Nurses -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Update Health Information</h3>
                    <p class="text-gray-600 mt-1">Keep your health information up to date</p>
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
            @endif

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
