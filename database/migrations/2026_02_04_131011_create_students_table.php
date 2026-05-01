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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->after('id')->nullable();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female']);
            $table->string('national_id')->unique(); // السجل المدني أو الهوية
            $table->string('address')->nullable();
            $table->string('student_code')->unique(); // رقم أكاديمي
            $table->enum('level', ['first', 'second', 'third'])->default('first'); // المستوى الدراسي (مثلاً: الأول الابتدائي)

            // إضافة حالة الطالب
            // active: نشط، graduated: خريج، transferred: منقول لفرع آخر
            $table->enum('status', ['active', 'graduated', 'inactive'])->default('active');

            // إضافة ربط الفرع كمفتاح أجنبي
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');    // إذا حذف الفرع (منطقياً لا ينصح بحذفه بل إيقافه)
            $table->foreignId('guardian_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
