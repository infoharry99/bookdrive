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
        Schema::create('testresponssheets', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->integer('student_id');
            $table->integer('attempt_no');
            $table->integer('question_id');
            $table->integer('correct_option');
            $table->integer('marked_option')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testresponssheets');
    }
};
