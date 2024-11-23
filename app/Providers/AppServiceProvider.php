<?php

namespace App\Providers;

use App\Models\Client; 
use App\Models\Admin; 
use App\Observers\Admin\ResetPasswordObserver as AdminResetPasswordObserver;
use Illuminate\Support\ServiceProvider;
use App\Services\Client\RegisterService;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        $this->app->singleton(RegisterService::class, function ($app) {
        return new RegisterService();
    });
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Admin::observe(AdminResetPasswordObserver::class);
    }
}
