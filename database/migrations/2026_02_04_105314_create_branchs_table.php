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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الفرع (مثلاً: فرع الخرطوم - الرياض)
            $table->string('city'); // المدينة (الخرطوم، مدني، بورتسودان)
            $table->string('address')->nullable(); // العنوان التفصيلي
            $table->string('phone')->nullable(); // رقم هاتف الفرع للتواصل
            
            // السعة الاستيعابية للفرع (اختياري - مفيد للشؤون الإدارية)
            $table->integer('capacity')->default(0); 

            // حالة الفرع (نشط أو مغلق للصيانة مثلاً)
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};