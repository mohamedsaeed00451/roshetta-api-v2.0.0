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
        Schema::create('prescripts', function (Blueprint $table) {
            $table->id();
            $table->string('serial');
            $table->date('rediscovery_date')->nullable()->comment('تاريخ إعادة الكشف');
            $table->foreignId('disease_id')->constrained('diseases')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('clinic_id')->constrained('clinics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescripts');
    }
};
