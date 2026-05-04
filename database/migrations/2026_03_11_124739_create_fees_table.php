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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users'); // الموظف المستلم

            // البعد الزمني للرسوم الشهرية
            $table->integer('fee_month'); // من 1 إلى 12
            $table->integer('fee_year');  // مثل 2026
            
            $table->decimal('amount_due', 10, 2);   // المبلغ المطلوب
            $table->decimal('amount_paid', 10, 2)->default(0); // المبلغ المدفوع
            $table->decimal('discount', 10, 2)->default(0);    // خصم خاص (إن وجد)
            
            $table->enum('payment_status', ['paid', 'partial', 'pending', 'overdue', 'exempt'])->default('pending');
            $table->enum('payment_method', ['Cash', 'Bank Transfer', 'Exempt'])->nullable();
            $table->enum('bank_name', ['BOK', 'O-Cash', 'Fawry', 'Mashreg'])->nullable();
            
            $table->string('transaction_id')->nullable(); // رقم الإشعار أو التحويل
            $table->date('payment_date')->nullable();     // تاريخ الدفع الفعلي
            $table->text('notes')->nullable();            // سبب الإعفاء أو ملاحظات أخرى
            
            $table->timestamps();

            // إضافة Index مركب لمنع دفع نفس الشهر مرتين لنفس الطالب
            $table->unique(['student_id', 'fee_month', 'fee_year'], 'unique_monthly_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
