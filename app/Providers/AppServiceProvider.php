<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Surfsidemedia\Shoppingcart\Cart;

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
        User::observe(\App\Observers\UserObserver::class);
    }
}
