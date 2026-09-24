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
            $table->integer('class_schedule_id')->nullable();
            $table->integer('contact_admin')->nullable()->default(0);
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
