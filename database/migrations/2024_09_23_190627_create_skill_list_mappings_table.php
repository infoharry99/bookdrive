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
        Schema::create('skill_list_mappings', function (Blueprint $table) {
            $table->id();
            $table->String('student_id')->nullable();
            $table->String('tutor_id')->nullable();
            $table->String('skill_id')->nullable();
            $table->String('skill_status_id')->nullable();
            $table->String('skill_rating')->nullable();
            $table->String('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_list_mappings');
    }
};
