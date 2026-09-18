<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        \Illuminate\Http\Request::setTrustedProxies(['*'], \Illuminate\Http\Request::HEADER_X_FORWARDED_ALL);
        Paginator::useBootstrap();
    }
}
