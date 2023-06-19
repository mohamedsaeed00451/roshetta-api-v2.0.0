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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ssd')->unique()->comment('الرقم القومى');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->date('birth_date');
            $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('email_isActive')->default(false)->comment('هل البريد الالكترونى مفعل ام لا');
            $table->boolean('account_isActive')->default(true)->comment('هل الحساب مفعل ام لا');
            $table->boolean('account_enable')->default(true)->comment('هل الحساب مفتوح ام مغلق لاسباب فنية او امنية');
            $table->boolean('account_run')->default(true)->comment('حالة الحساب الان نشط ام غير نشط');
            $table->text('image')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
