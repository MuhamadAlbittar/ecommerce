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
    Schema::create('vendor_shipping_methods', function (Blueprint $table) {
        $table->id();

        $table->foreignId('vendor_id')
              ->constrained('vendors')
              ->onDelete('cascade');

        $table->foreignId('shipping_method_id')
              ->constrained('shipping_methods')
              ->onDelete('cascade');

        $table->integer('cost')->nullable(); // stored in cents
        $table->integer('estimated_days')->nullable();

        $table->boolean('is_active')->default(true);

        $table->timestamps();

        $table->unique(['vendor_id', 'shipping_method_id']);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_shipping_methods');
    }
};
