<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solar_installations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('energy_audit_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('technician_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('system_size', 8, 2);
            $table->integer('panel_count');
            $table->decimal('estimated_production', 10, 2);
            $table->date('installation_date');
            $table->date('completion_date')->nullable();
            $table->enum('status', ['quoted', 'approved', 'in_progress', 'completed', 'maintenance'])->default('quoted');
            $table->json('project_files')->nullable();
            $table->integer('warranty_period')->default(25); // years
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['technician_id', 'installation_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solar_installations');
    }
};