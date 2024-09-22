<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CostumeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Services\Interfaces\FileTempService::class, \App\Services\FilePoundService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
