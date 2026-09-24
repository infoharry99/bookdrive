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
        Schema::create('zoom_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('tutor_id');
            $table->integer('batch_id');
            $table->string('uuid');
            $table->string('meeting_id');
            $table->string('host_id');
            $table->string('host_email');
            $table->string('topic_id');
            $table->string('topic_name');
            $table->integer('type');
            $table->string('status');
            $table->string('start_time');
            $table->integer('duration')->comment('minutes');
            $table->string('timezone');
            $table->string('agenda');
            $table->text('start_url');
            $table->text('join_url');
            $table->string('password')->comment('meeting password');
            $table->string('h323_password');
            $table->string('pstn_password');
            $table->string('encrypted_password');
            $table->integer('is_active')->default(1);
            $table->integer('is_completed')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_classes');
    }
};
