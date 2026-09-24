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
        Schema::create('studentprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('dob')->nullable();
            $table->string('grade');
            $table->bigInteger('mobile');
            $table->bigInteger('secondary_mobile')->unique()->nullable();
            $table->string('email')->unique();
            $table->tinyInteger('gender')->nullable();
            $table->string('school_name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->integer('student_id');
            $table->string('profile_pic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentprofiles');
    }
};
