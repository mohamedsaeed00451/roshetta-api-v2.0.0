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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('اسم الصيدلية');
            $table->string('phone')->unique()->comment('رقم هاتف الصيدلية');
            $table->string('serial')->comment('سيريال خاص لكل صيدلية');
            $table->time('start_working')->comment('موعد فتح الصيدلية');
            $table->time('end_working')->comment('موعد غلق الصيدلية');
            $table->text('address')->comment('عنوان الصيدلية بالتفصيل');
            $table->text('logo')->nullable()->comment('شعار الصيدلية');
            $table->boolean('account_isActive')->default(false)->comment('هل الحساب مفعل ام لا');
            $table->boolean('account_enable')->default(true)->comment('هل الحساب مفتوح ام مغلق لاسباب فنية او امنية');
            $table->boolean('account_run')->default(true)->comment('حالة الحساب الان نشط ام غير نشط');
            $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('owner_id')->comment('الدكتور صاحب الصيدلية')->constrained('pharmacists')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
