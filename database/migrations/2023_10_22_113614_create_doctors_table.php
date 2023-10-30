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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('doctor_id_number')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('speciality_id')->nullable();
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
