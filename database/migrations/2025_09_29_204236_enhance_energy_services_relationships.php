<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add energy_audit_id to maintenance_visits table
        Schema::table('maintenance_visits', function (Blueprint $table) {
            $table->foreignId('energy_audit_id')->nullable()->constrained('energy_audits')->onDelete('set null');
            $table->index(['energy_audit_id', 'visit_date']);
        });

        // Add maintenance_schedule and follow_up_required to energy_audits table
        Schema::table('energy_audits', function (Blueprint $table) {
            $table->json('maintenance_schedule')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->index(['follow_up_required', 'audit_status']);
        });

        // Add specialization_areas and certification_expiry to technicians table
        Schema::table('technicians', function (Blueprint $table) {
            $table->json('specialization_areas')->nullable();
            $table->date('certification_expiry')->nullable();
            $table->index(['certification_expiry', 'status']);
        });

        // Create audit_maintenance_tracking table for complex relationships
        Schema::create('audit_maintenance_tracking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('energy_audit_id')->constrained('energy_audits')->onDelete('cascade');
            $table->foreignId('maintenance_visit_id')->constrained('maintenance_visits')->onDelete('cascade');
            $table->boolean('recommendation_applied')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['energy_audit_id', 'maintenance_visit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_maintenance_tracking');
        
        Schema::table('technicians', function (Blueprint $table) {
            $table->dropColumn(['specialization_areas', 'certification_expiry']);
        });
        
        Schema::table('energy_audits', function (Blueprint $table) {
            $table->dropColumn(['maintenance_schedule', 'follow_up_required']);
        });
        
        Schema::table('maintenance_visits', function (Blueprint $table) {
            $table->dropForeign(['energy_audit_id']);
            $table->dropColumn('energy_audit_id');
        });
    }
};