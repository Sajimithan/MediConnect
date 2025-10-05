<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PatientRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'visit_date',
        'visit_type',
        'chief_complaint',
        'symptoms',
        'diagnosis',
        'treatment_plan',
        'prescription',
        'notes',
        'status',
        'next_appointment',
        'weight',
        'height',
        'blood_pressure_systolic',
        'blood_pressure_diastolic',
        'temperature',
        'heart_rate',
        'vital_signs_notes',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'next_appointment' => 'date',
        'weight' => 'decimal:2',
        'height' => 'decimal:2',
        'temperature' => 'decimal:1',
    ];

    /**
     * Get the patient that owns the record
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Get the doctor that created the record
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /**
     * Get formatted visit date
     */
    public function getFormattedVisitDateAttribute()
    {
        return $this->visit_date->format('M d, Y');
    }

    /**
     * Get formatted next appointment date
     */
    public function getFormattedNextAppointmentAttribute()
    {
        return $this->next_appointment ? $this->next_appointment->format('M d, Y') : 'Not scheduled';
    }

    /**
     * Get blood pressure reading
     */
    public function getBloodPressureAttribute()
    {
        if ($this->blood_pressure_systolic && $this->blood_pressure_diastolic) {
            return $this->blood_pressure_systolic . '/' . $this->blood_pressure_diastolic . ' mmHg';
        }
        return 'Not recorded';
    }

    /**
     * Scope for active records
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for completed records
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for records by doctor
     */
    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    /**
     * Scope for records by patient
     */
    public function scopeByPatient($query, $patientId)
    {
        return $query->where('patient_id', $patientId);
    }
}
