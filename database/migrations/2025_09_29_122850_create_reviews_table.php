<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('rating'); // 1-5
            $table->string('title');
            $table->text('comment');
            $table->json('photos')->nullable();
            $table->boolean('is_verified_purchase')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            $table->index(['product_id', 'is_approved']);
            $table->index(['user_id']);
            $table->index(['rating']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};