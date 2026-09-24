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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->string('tags')->nullable();
            $table->integer('is_featured')->default(0)->comment('0=No,1=Yes');
            $table->integer('is_active')->default(1);
            $table->string('published_by')->comment('Student/Tutor/Admin')->nullable();
            $table->integer('published_by_id')->comment('Student/Tutor/Admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
