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
        Schema::create('classschedules', function (Blueprint $table) {
            $table->id();
            $table->integer('batch_id');
            $table->integer('topic_id');
            $table->integer('tutor_id');
            $table->string('class_link');
            $table->string('start_time');
            $table->string('end_time')->nullable();
            $table->integer('status')->default(1);
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classschedules');
    }
};
