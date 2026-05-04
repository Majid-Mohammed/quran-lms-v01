<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('address')->nullable();
            $table->string('specialization')->nullable();
            $table->date('hire_date')->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
