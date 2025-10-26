<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\MailHelper;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Set mail configuration from database on every request
        try {
            MailHelper::setMailConfig();
        } catch (\Exception $e) {
            // Log error but don't break the application
            \Log::error('Failed to set mail configuration: ' . $e->getMessage());
        }
    }
}



