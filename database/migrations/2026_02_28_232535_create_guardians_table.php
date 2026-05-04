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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // الاسم الكامل
            $table->string('national_id')->unique(); // السجل المدني أو الهوية
            $table->string('phone_number'); // رقم الجوال   
            $table->string('job')->nullable(); // المهنة
            $table->enum('relation_type', ['father', 'mother', 'brother', 'sister', 'grandfather', 'grandmother', 'other']); // صلة القرابة
            $table->text('address')->nullable(); // العنوان
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
