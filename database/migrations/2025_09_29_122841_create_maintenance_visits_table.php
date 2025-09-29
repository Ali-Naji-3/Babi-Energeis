<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solar_installation_id')->constrained()->onDelete('cascade');
            $table->foreignId('technician_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->enum('visit_type', ['routine', 'repair', 'inspection']);
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->json('photos')->nullable();
            $table->json('parts_used')->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->timestamps();
            
            $table->index(['solar_installation_id', 'visit_date']);
            $table->index(['technician_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_visits');
    }
};