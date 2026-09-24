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
        Schema::create('skill_lists', function (Blueprint $table) {
            $table->id();
            $table->String('skill_type')->nullable();
            $table->String('skill_name')->nullable();
            $table->String('skill_status')->nullable();
            $table->String('skill_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_lists');
    }
};
