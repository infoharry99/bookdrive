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
        Schema::create('testattempteds', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('test_id');
            $table->integer('attempt_no');
            $table->timestamp('test_attempted_on')->default(now());
            $table->string('test_time_taken');
            $table->string('total_marks');
            $table->string('obtained_marks');
            $table->integer('response_id');
            $table->integer('status')->nullable();
            $table->integer('is_active')->default(1);
            $table->longText('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testattempteds');
    }
};
