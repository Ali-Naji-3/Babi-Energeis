<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'specialization',
        'certification_level',
        'experience_years',
        'hourly_rate',
        'availability_schedule',
        'rating',
        'status',
    ];

    protected $casts = [
        'hourly_rate' => 'decimal:2',
        'rating' => 'decimal:2',
        'availability_schedule' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function energyAudits()
    {
        return $this->hasMany(EnergyAudit::class);
    }

    public function solarInstallations()
    {
        return $this->hasMany(SolarInstallation::class);
    }

    public function maintenanceVisits()
    {
        return $this->hasMany(MaintenanceVisit::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeBySpecialization($query, $specialization)
    {
        return $query->where('specialization', $specialization);
    }

    // Methods
    public function isAvailable()
    {
        return $this->status === 'available';
    }

    public function getFullNameAttribute()
    {
        return $this->user->name ?? 'Unknown';
    }
}