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
        Schema::create('transport', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('set null');
            $table->foreignId('from_branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->foreignId('to_branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->string('reason');
            $table->date('transport_date');
            $table->enum('status',['accepted','rejected','waiting'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport');
    }
};
