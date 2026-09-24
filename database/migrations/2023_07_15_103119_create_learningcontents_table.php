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
        Schema::create('learningcontents', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('topic_id')->nullable();
            // $table->integer('student_id')->nullable();
            $table->string('content_link')->nullable();
            $table->string('content_description')->nullable();
            $table->string('video_link')->nullable();
            $table->string('video_description')->nullable();
            $table->string('blog_link')->nullable();
            $table->string('blog_description')->nullable();
            $table->integer('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learningcontents');
    }
};
