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
    Schema::table('testattempteds', function (Blueprint $table) {
        // Change the data type of the column
        $table->text('response_id')->change();
        $table->longText('answer')->nullable();
        // You can modify other properties as well
        // $table->unsignedBigInteger('another_column')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('table_name', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->integer('column_name')->change();
            // $table->integer('another_column')->change();
        });
    }
};
