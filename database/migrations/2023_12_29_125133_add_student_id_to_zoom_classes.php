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
        Schema::table('zoom_classes', function (Blueprint $table) {
            $table->integer('student_id')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('student_present')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zoom_classes', function (Blueprint $table) {
            //
        });
    }
};
