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
Route::get('/admin', function () {
    return view('admin.index');
});


// Route::view('/about', 'about')->name('about');
// Route::view('/cycle', 'cycle')->name('cycle');
// Route::view('/news', 'news')->name('news');
// Route::view('/contact', 'contact')->name('contact');
// Route::view('/shop', 'shop')->name('shop');


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
