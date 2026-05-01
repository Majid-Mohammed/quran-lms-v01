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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default(bcrypt('12345')); // تأكد من تغيير كلمة المرور الافتراضية في بيئة الإنتاج

            // إضافة حقل الأدوار
            // admin: المدير العام, manager: مدير الفرع, register: الشؤون الإدارية, teacher: مدرس, student: طالب
            $table->enum('role', ['admin', 'manager', 'register', 'teacher', 'student'])->default('student');

            // إضافة حقل الفرع
            // نجعله nullable لأن المدير العام (admin) قد لا يتبع لفرع معين
            $table->foreignId('branch_id')->nullable()->constrained()->onDelete('set null');
            
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
