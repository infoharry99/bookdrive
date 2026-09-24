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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('alert_type');
            $table->text('notification');
            // Notification Created By
            $table->integer('initiator_id');
            $table->integer('initiator_role');
            $table->integer('event_id');
            // Check for admin visiblity
            $table->integer('show_to_admin')->default(0)->nullable();
            $table->integer('show_to_admin_id')->default(0)->nullable();
            $table->integer('show_to_all_admin')->default(0)->nullable();
            // Check for tutor visiblity
            $table->integer('show_to_tutor')->default(0)->nullable();
            $table->integer('show_to_tutor_id')->default(0)->nullable();
            $table->integer('show_to_all_tutor')->default(0)->nullable();
            // Check for student visiblity
            $table->integer('show_to_student')->default(0)->nullable();
            $table->integer('show_to_student_id')->default(0)->nullable();
            $table->integer('show_to_all_student')->default(0)->nullable();
            // Check for parent visiblity
            $table->integer('show_to_parent')->default(0)->nullable();
            $table->integer('show_to_parent_id')->default(0)->nullable();
            $table->integer('show_to_all_parent')->default(0)->nullable();
            // Check read status
            $table->integer('read_status')->default(0)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
