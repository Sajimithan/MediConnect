<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PatientRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:doctor,admin')->except(['patientView']);
    }

    /**
     * Display a listing of patient records for doctors
     */
    public function index()
    {
        $doctor = Auth::user();
        $patientRecords = PatientRecord::with(['patient', 'doctor'])
            ->byDoctor($doctor->id)
            ->orderBy('visit_date', 'desc')
            ->paginate(10);

        return view('patient-records.index', compact('patientRecords'));
    }

    /**
     * Show the form for creating a new patient record
     */
    public function create($patientId = null)
    {
        $patients = User::where('role', 'patient')->get();
        $selectedPatient = $patientId ? User::find($patientId) : null;
        
        return view('patient-records.create', compact('patients', 'selectedPatient'));
    }

    /**
     * Store a newly created patient record
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'visit_type' => 'required|string|in:consultation,follow_up,emergency,routine_checkup',
            'chief_complaint' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment_plan' => 'nullable|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
            'next_appointment' => 'nullable|date|after:visit_date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'blood_pressure_systolic' => 'nullable|integer|min:0|max:300',
            'blood_pressure_diastolic' => 'nullable|integer|min:0|max:300',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'heart_rate' => 'nullable|integer|min:30|max:200',
            'vital_signs_notes' => 'nullable|string',
        ]);

        $record = PatientRecord::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::id(),
            'visit_date' => $request->visit_date,
            'visit_type' => $request->visit_type,
            'chief_complaint' => $request->chief_complaint,
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'treatment_plan' => $request->treatment_plan,
            'prescription' => $request->prescription,
            'notes' => $request->notes,
            'next_appointment' => $request->next_appointment,
            'weight' => $request->weight,
            'height' => $request->height,
            'blood_pressure_systolic' => $request->blood_pressure_systolic,
            'blood_pressure_diastolic' => $request->blood_pressure_diastolic,
            'temperature' => $request->temperature,
            'heart_rate' => $request->heart_rate,
            'vital_signs_notes' => $request->vital_signs_notes,
        ]);

        return redirect()->route('patient-records.show', $record->id)
            ->with('success', 'Patient record created successfully!');
    }

    /**
     * Display the specified patient record
     */
    public function show(PatientRecord $patientRecord)
    {
        $patientRecord->load(['patient', 'doctor']);
        
        // Check if user has access to this record
        if (Auth::user()->isDoctor() && $patientRecord->doctor_id !== Auth::id()) {
            abort(403, 'Unauthorized access to patient record.');
        }
        
        if (Auth::user()->isPatient() && $patientRecord->patient_id !== Auth::id()) {
            abort(403, 'Unauthorized access to patient record.');
        }

        return view('patient-records.show', compact('patientRecord'));
    }

    /**
     * Show the form for editing the specified patient record
     */
    public function edit(PatientRecord $patientRecord)
    {
        // Only the doctor who created the record can edit it
        if ($patientRecord->doctor_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access to edit patient record.');
        }

        return view('patient-records.edit', compact('patientRecord'));
    }

    /**
     * Update the specified patient record
     */
    public function update(Request $request, PatientRecord $patientRecord)
    {
        // Only the doctor who created the record can update it
        if ($patientRecord->doctor_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access to update patient record.');
        }

        $request->validate([
            'visit_date' => 'required|date',
            'visit_type' => 'required|string|in:consultation,follow_up,emergency,routine_checkup',
            'chief_complaint' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment_plan' => 'nullable|string',
            'prescription' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|string|in:active,completed,cancelled',
            'next_appointment' => 'nullable|date|after:visit_date',
            'weight' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'blood_pressure_systolic' => 'nullable|integer|min:0|max:300',
            'blood_pressure_diastolic' => 'nullable|integer|min:0|max:300',
            'temperature' => 'nullable|numeric|min:30|max:45',
            'heart_rate' => 'nullable|integer|min:30|max:200',
            'vital_signs_notes' => 'nullable|string',
        ]);

        $patientRecord->update($request->all());

        return redirect()->route('patient-records.show', $patientRecord->id)
            ->with('success', 'Patient record updated successfully!');
    }

    /**
     * Remove the specified patient record
     */
    public function destroy(PatientRecord $patientRecord)
    {
        // Only the doctor who created the record or admin can delete it
        if ($patientRecord->doctor_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access to delete patient record.');
        }

        $patientRecord->delete();

        return redirect()->route('patient-records.index')
            ->with('success', 'Patient record deleted successfully!');
    }

    /**
     * View patient records for a specific patient (doctor's view)
     */
    public function patientRecords($patientId)
    {
        $patient = User::findOrFail($patientId);
        $records = PatientRecord::with(['doctor'])
            ->byPatient($patientId)
            ->byDoctor(Auth::id())
            ->orderBy('visit_date', 'desc')
            ->get();

        return view('patient-records.patient-history', compact('patient', 'records'));
    }

    /**
     * Patient's view of their own records
     */
    public function patientView()
    {
        $patient = Auth::user();
        $records = PatientRecord::with(['doctor'])
            ->byPatient($patient->id)
            ->orderBy('visit_date', 'desc')
            ->paginate(10);

        return view('patient-records.patient-view', compact('records'));
    }
}
