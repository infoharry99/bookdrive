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
        Schema::create('tutor_requests', function (Blueprint $table) {
            $table->id();
            $table->String('full_name')->nullable();
            $table->String('mobile')->nullable();
            $table->String('email')->nullable();
            $table->String('city')->nullable();
            $table->String('location')->nullable();
            $table->String('no_of_classes')->nullable();
            $table->String('start_date')->nullable();
            $table->String('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_requests');
    }
};
