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
        Schema::create('online_tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->integer('topic_id')->nullable();
            $table->float('max_attempt');
            $table->float('test_duration');
            $table->string('test_start_date');
            $table->string('test_end_date');
            $table->text('question_id');
            $table->smallInteger('test_type');
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_tests');
    }
};
