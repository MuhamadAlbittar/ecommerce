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
        Schema::create('order_shipments', function (Blueprint $table) {
      
        $table->id();

        // الربط مع جدول الكسر order_vendors
        $table->foreignId('order_vendor_id')
              ->constrained('order_vendors')
              ->onDelete('cascade');

        // الربط مع جدول طرق الشحن
        $table->foreignId('shipping_method_id')
              ->constrained('shipping_methods')
              ->onDelete('cascade');

        $table->string('tracking_number')->nullable();
        $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])
              ->default('pending');

        $table->timestamp('shipped_at')->nullable();
        $table->timestamp('delivered_at')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shipments');
    }
};
