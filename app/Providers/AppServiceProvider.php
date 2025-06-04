<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
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
    Paginator::useBootstrap();

    // Pasang view composer untuk semua view, yang dijalankan *setelah* session middleware.
    View::composer('*', function ($view) {
        // Ambil session 'theme', default 'active'
        $theme = session('theme', 'active');
        $view->with('themeClass', $theme);
    });
}
}

