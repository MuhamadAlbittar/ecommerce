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
    Schema::create('refunds', function (Blueprint $table) {
        $table->id();

        // الربط مع عملية الدفع
        $table->foreignId('order_payment_id')
              ->constrained('order_payments')
              ->onDelete('cascade');

        // الربط مع التاجر داخل الطلب
        $table->foreignId('order_vendor_id')
              ->constrained('order_vendors')
              ->onDelete('cascade');

        // المبلغ المسترجع (بالـ cents)
        $table->integer('amount');

        // سبب الاسترجاع
        $table->string('reason')->nullable();

        // حالة الاسترجاع
        $table->enum('status', ['pending', 'processed', 'failed'])
              ->default('pending');

        $table->timestamp('refunded_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
