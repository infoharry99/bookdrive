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
        Schema::create('my_favourites', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('tutor_id');
            $table->integer('status')->default('1')->nullable();
            $table->integer('is_active')->default('1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_favourites');
    }
};
