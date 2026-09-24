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
        Schema::create('student_assignment_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('topic_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('assigned_by')->nullable();
            $table->string('assignment_description')->nullable();
            $table->string('assignment_link')->nullable();
            $table->string('assignment_start_date')->nullable();
            $table->string('assignment_end_date')->nullable();
            $table->integer('is_active')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_assignment_lists');
    }
};
