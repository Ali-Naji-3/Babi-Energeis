<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Technician;
use App\Models\EnergyAudit;
use App\Models\SolarInstallation;
use App\Models\MaintenanceVisit;
use App\Models\AuditMaintenanceTracking;
use Illuminate\Support\Facades\Hash;

class LebanonDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Lebanese users
        $this->createLebaneseUsers();
        
        // Create Lebanese technicians
        $this->createLebaneseTechnicians();
        
        // Create Lebanese energy audits
        $this->createLebaneseEnergyAudits();
        
        // Create Lebanese solar installations
        $this->createLebaneseSolarInstallations();
        
        // Create Lebanese maintenance visits
        $this->createLebaneseMaintenanceVisits();
        
        $this->command->info('Lebanese data seeded successfully!');
    }

    private function createLebaneseUsers()
    {
        $users = [
            [
                'name' => 'Ahmad Khalil',
                'email' => 'ahmad.khalil@example.com',
                'password' => Hash::make('password'),
                'phone' => '+961-1-234567',
                'address' => 'Hamra, Beirut, Lebanon'
            ],
            [
                'name' => 'Fatima Mansour',
                'email' => 'fatima.mansour@example.com',
                'password' => Hash::make('password'),
                'phone' => '+961-1-345678',
                'address' => 'Achrafieh, Beirut, Lebanon'
            ],
            [
                'name' => 'Omar Fadel',
                'email' => 'omar.fadel@example.com',
                'password' => Hash::make('password'),
                'phone' => '+961-1-456789',
                'address' => 'Verdun, Beirut, Lebanon'
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }

    private function createLebaneseTechnicians()
    {
        $technicians = [
            [
                'user_id' => 1,
                'employee_id' => 'TECH-001',
                'employee_name' => 'Ahmad Khalil',
                'specialization' => 'Solar Panel Installation',
                'certification_level' => 'Advanced',
                'experience_years' => 8,
                'hourly_rate' => 25.00,
                'rating' => 4.8,
                'status' => 'available',
                'specialization_areas' => ['Solar Installation', 'Energy Audit'],
                'certification_expiry' => now()->addYears(2)
            ],
            [
                'user_id' => 2,
                'employee_id' => 'TECH-002',
                'employee_name' => 'Fatima Mansour',
                'specialization' => 'Energy Audit Specialist',
                'certification_level' => 'Expert',
                'experience_years' => 12,
                'hourly_rate' => 30.00,
                'rating' => 4.9,
                'status' => 'available',
                'specialization_areas' => ['Energy Audit', 'HVAC Systems'],
                'certification_expiry' => now()->addYears(3)
            ]
        ];

        foreach ($technicians as $techData) {
            Technician::create($techData);
        }
    }

    private function createLebaneseEnergyAudits()
    {
        $audits = [
            [
                'user_id' => 3,
                'technician_id' => 1,
                'property_type' => 'Residential Villa',
                'property_address' => 'Hamra Street, Beirut, Lebanon',
                'property_size' => 250,
                'current_energy_usage' => 850.50,
                'audit_date' => now()->addDays(3),
                'audit_status' => 'scheduled',
                'recommendations' => ['Install solar panels', 'Upgrade HVAC system'],
                'estimated_savings' => 1200.00,
                'notes' => 'Large villa with high energy consumption potential.',
                'follow_up_required' => true
            ],
            [
                'user_id' => 3,
                'technician_id' => 2,
                'property_type' => 'Commercial Building',
                'property_address' => 'Achrafieh, Beirut, Lebanon',
                'property_size' => 1200,
                'current_energy_usage' => 2500.75,
                'audit_date' => now()->subDays(5),
                'audit_status' => 'completed',
                'recommendations' => ['Install energy-efficient lighting', 'Add solar panels'],
                'estimated_savings' => 3500.00,
                'notes' => 'Commercial building audit completed successfully.',
                'follow_up_required' => true
            ]
        ];

        foreach ($audits as $auditData) {
            EnergyAudit::create($auditData);
        }
    }

    private function createLebaneseSolarInstallations()
    {
        $installations = [
            [
                'user_id' => 3,
                'energy_audit_id' => 1,
                'technician_id' => 1,
                'system_size' => 5.5,
                'panel_count' => 20,
                'estimated_production' => 7500.00,
                'installation_date' => now()->addDays(7),
                'status' => 'quoted',
                'warranty_period' => 25,
                'notes' => 'Solar installation for residential villa in Hamra.'
            ]
        ];

        foreach ($installations as $installationData) {
            SolarInstallation::create($installationData);
        }
    }

    private function createLebaneseMaintenanceVisits()
    {
        $visits = [
            [
                'solar_installation_id' => 1,
                'technician_id' => 1,
                'energy_audit_id' => 1,
                'visit_date' => now()->addDays(14),
                'visit_type' => 'routine',
                'status' => 'scheduled',
                'notes' => 'Routine maintenance for solar system in Hamra.',
                'cost' => 150.00
            ]
        ];

        foreach ($visits as $visitData) {
            MaintenanceVisit::create($visitData);
        }
    }
}