<?php

namespace App\Providers;

use App\Http\Interfaces\Api\V1\LoginRepositoryInterface;
use App\Http\Repositories\Api\V1\LoginRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginRepositoryInterface::class, LoginRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
