<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Create Patient Record 👨‍⚕️
                </h2>
                <p class="text-gray-600 mt-1">Add a new medical record for a patient</p>
            </div>
            <div>
                <a href="{{ route('patient-records.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md font-medium transition-colors">
                    Back to Records
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('patient-records.store') }}" class="space-y-8">
                @csrf
                
                <!-- Patient Selection -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Patient Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="patient_id" class="block text-sm font-medium text-gray-700">Select Patient</label>
                                <select name="patient_id" id="patient_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Choose a patient...</option>
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" 
                                                {{ $selectedPatient && $selectedPatient->id === $patient->id ? 'selected' : '' }}>
                                            {{ $patient->name }} ({{ $patient->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="visit_date" class="block text-sm font-medium text-gray-700">Visit Date</label>
                                <input type="date" name="visit_date" id="visit_date" 
                                       value="{{ old('visit_date', now()->format('Y-m-d')) }}" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('visit_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="visit_type" class="block text-sm font-medium text-gray-700">Visit Type</label>
                                <select name="visit_type" id="visit_type" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select visit type...</option>
                                    <option value="consultation" {{ old('visit_type') === 'consultation' ? 'selected' : '' }}>Consultation</option>
                                    <option value="follow_up" {{ old('visit_type') === 'follow_up' ? 'selected' : '' }}>Follow-up</option>
                                    <option value="emergency" {{ old('visit_type') === 'emergency' ? 'selected' : '' }}>Emergency</option>
                                    <option value="routine_checkup" {{ old('visit_type') === 'routine_checkup' ? 'selected' : '' }}>Routine Checkup</option>
                                </select>
                                @error('visit_type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="next_appointment" class="block text-sm font-medium text-gray-700">Next Appointment</label>
                                <input type="date" name="next_appointment" id="next_appointment" 
                                       value="{{ old('next_appointment') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('next_appointment')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Medical Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Medical Information
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="chief_complaint" class="block text-sm font-medium text-gray-700">Chief Complaint</label>
                            <textarea name="chief_complaint" id="chief_complaint" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Primary reason for the visit...">{{ old('chief_complaint') }}</textarea>
                            @error('chief_complaint')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="symptoms" class="block text-sm font-medium text-gray-700">Symptoms</label>
                            <textarea name="symptoms" id="symptoms" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Describe the symptoms...">{{ old('symptoms') }}</textarea>
                            @error('symptoms')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                            <textarea name="diagnosis" id="diagnosis" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Medical diagnosis...">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="treatment_plan" class="block text-sm font-medium text-gray-700">Treatment Plan</label>
                            <textarea name="treatment_plan" id="treatment_plan" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Treatment plan and recommendations...">{{ old('treatment_plan') }}</textarea>
                            @error('treatment_plan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="prescription" class="block text-sm font-medium text-gray-700">Prescription</label>
                            <textarea name="prescription" id="prescription" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Medications prescribed...">{{ old('prescription') }}</textarea>
                            @error('prescription')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Vital Signs -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Vital Signs
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" step="0.1" name="weight" id="weight" 
                                       value="{{ old('weight') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Enter weight">
                                @error('weight')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                                <input type="number" step="0.1" name="height" id="height" 
                                       value="{{ old('height') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Enter height">
                                @error('height')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="temperature" class="block text-sm font-medium text-gray-700">Temperature (°C)</label>
                                <input type="number" step="0.1" name="temperature" id="temperature" 
                                       value="{{ old('temperature') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Enter temperature">
                                @error('temperature')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="blood_pressure_systolic" class="block text-sm font-medium text-gray-700">Blood Pressure (Systolic)</label>
                                <input type="number" name="blood_pressure_systolic" id="blood_pressure_systolic" 
                                       value="{{ old('blood_pressure_systolic') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Systolic">
                                @error('blood_pressure_systolic')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="blood_pressure_diastolic" class="block text-sm font-medium text-gray-700">Blood Pressure (Diastolic)</label>
                                <input type="number" name="blood_pressure_diastolic" id="blood_pressure_diastolic" 
                                       value="{{ old('blood_pressure_diastolic') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Diastolic">
                                @error('blood_pressure_diastolic')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="heart_rate" class="block text-sm font-medium text-gray-700">Heart Rate (BPM)</label>
                                <input type="number" name="heart_rate" id="heart_rate" 
                                       value="{{ old('heart_rate') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="Enter heart rate">
                                @error('heart_rate')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label for="vital_signs_notes" class="block text-sm font-medium text-gray-700">Vital Signs Notes</label>
                            <textarea name="vital_signs_notes" id="vital_signs_notes" rows="2"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Additional notes about vital signs...">{{ old('vital_signs_notes') }}</textarea>
                            @error('vital_signs_notes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Additional Notes
                        </h3>
                    </div>
                    <div class="p-6">
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Doctor's Notes</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Additional observations, recommendations, or notes...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('patient-records.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-md font-medium transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium transition-colors">
                        Create Patient Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
