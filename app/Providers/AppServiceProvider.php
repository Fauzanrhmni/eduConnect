<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

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
        // Anda bisa mendaftarkan middleware langsung di sini
        Route::aliasMiddleware('rolemanager', RoleManager::class);

        View::composer('*', function ($view) {
            $view->with('user', Auth::user());
        });
    }
}
