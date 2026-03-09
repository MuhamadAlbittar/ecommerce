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
    Schema::create('order_vendors', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
        $table->integer('total_price'); // stored in cents
        $table->integer('total_items');
        $table->timestamps();

        $table->unique(['order_id', 'vendor_id']);
    });
}
//حساب order_vendors
//  أثناء عملية الـ checkout
// foreach ($grouped as $vendorId => $items) {
//     $totalPrice = $items->sum(fn($item) => $item->price_at_time * $item->quantity);
//     $totalItems = $items->sum('quantity');

//     OrderVendor::create([
//         'order_id' => $order->id,
//         'vendor_id' => $vendorId,
//         'total_price' => $totalPrice,
//         'total_items' => $totalItems,
//     ]);
// }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_vendors');
    }
};
