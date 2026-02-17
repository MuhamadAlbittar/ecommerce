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
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vendor_id')
                  ->constrained('vendors')
                  ->onDelete('cascade');

            $table->foreignId('product_id')
                  ->constrained('products')
                  ->onDelete('cascade');
             // تعريف المخزون للبائع
            $table->string('sku')->unique()->nullable(); // Stock Keeping Unit
            $table->unique(['vendor_id', 'sku']);

            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->decimal('discount', 5, 2)->default(0); // نسبة الخصم %

            $table->string('warranty')->nullable();

            $table->enum('status', ['active', 'inactive'])
                  ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_products');
    }
};
