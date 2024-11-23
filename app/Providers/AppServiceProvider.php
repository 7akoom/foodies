<?php

namespace App\Providers;

use App\Models\Client; 
use App\Models\Admin; 
use App\Observers\Admin\ResetPasswordObserver as AdminResetPasswordObserver;
use App\Observers\Client\ResetPasswordObserver as ClientResetPasswordObserver;
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

        Client::observe(ClientResetPasswordObserver::class);
        Admin::observe(AdminResetPasswordObserver::class);
    }
}
