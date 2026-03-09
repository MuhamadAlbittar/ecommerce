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
    Schema::create('refund_items', function (Blueprint $table) {
        $table->id();

        // الربط مع refund
        $table->foreignId('refund_id')
              ->constrained('refunds')
              ->onDelete('cascade');

        // الربط مع order_item
        $table->foreignId('order_item_id')
              ->constrained('order_items')
              ->onDelete('cascade');

        // الكمية المسترجعة
        $table->integer('quantity');

        // snapshot للسعر وقت الشراء
        $table->integer('price_at_refund');

        // snapshot للمجموع
        $table->integer('total_amount');

        // ملاحظات إضافية
        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_items');
    }
};
