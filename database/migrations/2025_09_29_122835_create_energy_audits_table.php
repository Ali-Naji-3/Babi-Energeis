<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('energy_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('technician_id')->nullable()->constrained()->onDelete('set null');
            $table->string('property_type');
            $table->text('property_address');
            $table->integer('property_size');
            $table->decimal('current_energy_usage', 10, 2);
            $table->date('audit_date');
            $table->enum('audit_status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->json('recommendations')->nullable();
            $table->decimal('estimated_savings', 10, 2)->nullable();
            $table->string('report_file')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'audit_status']);
            $table->index(['technician_id', 'audit_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('energy_audits');
    }
};