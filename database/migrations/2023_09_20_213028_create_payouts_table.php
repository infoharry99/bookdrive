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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->integer('tutor_id');
            $table->decimal('total_amount', 10, 2); // Amount (e.g., 12345.67)
            $table->decimal('net_amount_received', 10, 2); // Amount
            $table->decimal('admin_commission_percentage', 5, 2); // Percentage (e.g., 10.50)
            $table->decimal('admin_commission_amount', 10, 2); // Amount
            $table->string('account_no'); // VARCHAR
            $table->string('transaction_no'); // VARCHAR
            $table->timestamp('transaction_date'); // Timestamp
            $table->smallInteger('status'); // Small Integer (You may adjust this as needed)
            $table->smallInteger('payment_mode'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
