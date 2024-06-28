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
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('student_id');
            $table->string('registration_number');
            $table->string('subject1_marks')->nullable();
            $table->string('subject2_marks')->nullable();
            $table->string('subject3_marks')->nullable();
            $table->string('subject4_marks')->nullable();
            $table->string('subject5_marks')->nullable();
            $table->timestamps();

            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('registration_number')->references('registration_number')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
