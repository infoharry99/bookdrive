<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paymentdetails', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('payment_mode');
            $table->timestamp('payment_date')->useCurrent();
            // $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('amount');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymentdetails');
    }
};
