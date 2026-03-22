<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Vendor;
use App\Policies\VendorPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
    protected $policies = [Vendor::class => VendorPolicy::class,];
}
