<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('اسم العيادة');
            $table->string('phone')->unique()->comment('رقم هاتف العيادة');
            $table->string('serial')->comment('سيريال خاص لكل عيادة');
            $table->float('price')->comment('سعر الكشف');
            $table->time('start_working')->comment('موعد فتح العيادة');
            $table->time('end_working')->comment('موعد غلق العيادة');
            $table->text('address')->comment('عنوان العيادة بالتفصيل');
            $table->text('logo')->nullable()->comment('شعار العيادة');
            $table->boolean('account_isActive')->default(false)->comment('هل الحساب مفعل ام لا');
            $table->boolean('account_enable')->default(true)->comment('هل الحساب مفتوح ام مغلق لاسباب فنية او امنية');
            $table->boolean('account_run')->default(true)->comment('حالة الحساب الان نشط ام غير نشط');
            $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('owner_id')->comment('الدكتور صاحب العيادة')->constrained('doctors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('specialist_id')->constrained('specialists')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('assistant_id')->comment('المساعد بتاع العيادة')->nullable()->constrained('assistants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
