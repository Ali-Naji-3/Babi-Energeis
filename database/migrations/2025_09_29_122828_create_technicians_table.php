<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('employee_id')->unique();
            $table->string('specialization');
            $table->string('certification_level');
            $table->integer('experience_years');
            $table->decimal('hourly_rate', 8, 2);
            $table->json('availability_schedule')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->enum('status', ['available', 'busy', 'offline'])->default('available');
            $table->timestamps();
            
            $table->index(['status', 'specialization']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};