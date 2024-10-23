<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MidtransServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env("MIDTRANS_IS_PRODUCTION");
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = env("MIDTRANS_IS_SANITIZED");
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = env("MIDTRANS_IS_3DS");
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
