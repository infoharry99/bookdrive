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
        Schema::table('slot_bookings', function (Blueprint $table) {
            $table->integer('is_class_scheduled')->nullable()->default(0);
            $table->integer('meeting_id')->nullable();
            $table->string('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('slot_bookings', function (Blueprint $table) {
            //
        });
    }
};
