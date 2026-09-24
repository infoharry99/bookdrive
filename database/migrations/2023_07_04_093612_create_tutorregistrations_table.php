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
        Schema::create('tutorregistrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('mobile')->unique();
            $table->string('email')->unique();
            $table->integer('is_mobile_verified')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->integer('is_email_verified')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('role_id');
            $table->integer('is_active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorregistrations');
    }
};
