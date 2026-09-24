<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tutorprofiles', function (Blueprint $table) {
            $table->decimal('admin_commission', 8, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('tutorprofiles', function (Blueprint $table) {
            $table->decimal('admin_commission', 8, 2)->nullable(false)->change();
        });
    }
};
