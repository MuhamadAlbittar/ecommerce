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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('cart_id')->constrained()->onDelete('cascade');
        $table->foreignId('shipping_method_id')->nullable()->constrained('shipping_methods');
        $table->foreignId('shipping_address_id')->nullable()->constrained('user_addresses');
        
        $table->integer('total_price'); // stored in cents
        $table->enum('status', ['Pending', 'Delivered', 'Cancelled','Processing'])->default('Pending');
        $table->timestamps();
    });
//     Schema::table('orders', function (Blueprint $table) {
        
        // });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
