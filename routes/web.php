<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    OrdersController,
    OrderItemsController,
    OrderVendorsController,
    OrderShipmentsController,
    CartsController,
    CartItemsController,
    ProductsController,
    VendorProductsController,
    VendorsController,
    VendorUsersController,
    CategoriesController,
    ProductCategoriesController,
    PaymentsController,
    PaymentMethodsController,
    RefundsController,
    RefundItemsController,
    ShippingMethodsController,
    VendorShippingMethodsController
};

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'orders' => OrdersController::class,
    'order-items' => OrderItemsController::class,
    'order-vendors' => OrderVendorsController::class,
    'order-shipments' => OrderShipmentsController::class,

    'carts' => CartsController::class,
    'cart-items' => CartItemsController::class,

    'products' => ProductsController::class,
    'vendor-products' => VendorProductsController::class,

    'vendors' => VendorsController::class,
    'vendor-users' => VendorUsersController::class,

    'categories' => CategoriesController::class,
    'product-categories' => ProductCategoriesController::class,

    'payments' => PaymentsController::class,
    'payment-methods' => PaymentMethodsController::class,

    'refunds' => RefundsController::class,
    'refund-items' => RefundItemsController::class,

    'shipping-methods' => ShippingMethodsController::class,
    'vendor-shipping-methods' => VendorShippingMethodsController::class,
]);
