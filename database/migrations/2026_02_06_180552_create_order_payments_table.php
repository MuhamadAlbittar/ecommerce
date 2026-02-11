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
    Schema::create('order_payments', function (Blueprint $table) {
        $table->id();

        $table->foreignId('order_id')
              ->constrained('orders')
              ->onDelete('cascade');

        $table->foreignId('payment_method_id')
              ->constrained('payment_methods')
              ->onDelete('cascade');

        $table->integer('amount'); // stored in cents
        $table->string('status')->default('pending'); 
        $table->string('transaction_id')->nullable();
        $table->json('transaction_data')->nullable();

        $table->timestamp('paid_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
