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
        Schema::create('assign_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->integer('student_id');
            $table->integer('tutor_id');
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('topic_id')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('status')->default(0);
            $table->integer('is_attempted')->default(0);
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_tests');
    }
};
