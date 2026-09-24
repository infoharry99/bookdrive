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
        Schema::create('democlasses', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('tutor_id');
            $table->integer('subject_id');
            $table->timestamp('slot_1');
            $table->timestamp('slot_2')->nullable();
            $table->timestamp('slot_3')->nullable();
            $table->timestamp('slot_confirmed')->nullable();
            $table->timestamp('slot_confirmed_at')->nullable();
            $table->integer('slot_confirmed_by')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('democlasses');
    }
};
