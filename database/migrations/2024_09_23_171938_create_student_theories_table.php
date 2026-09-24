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
        Schema::create('student_theories', function (Blueprint $table) {
            $table->id();
            $table->String('student_id')->nullable();
            $table->String('tutor_id')->nullable();
            $table->String('location')->nullable();
            $table->String('date')->nullable();
            $table->String('marks')->nullable();
            $table->String('description')->nullable();
            $table->String('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_theories');
    }
};
