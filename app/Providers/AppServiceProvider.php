<?php

namespace App\Providers;

use App\Http\Interfaces\Api\V1\LoginRepositoryInterface;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Interfaces\Api\V1\PersonalDataRepositoryInterface;
use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use App\Http\Repositories\Api\V1\LoginRepository;
use App\Http\Repositories\Api\V1\BookingHourRepository;
use App\Http\Repositories\Api\V1\PersonalDataRepository;
use App\Http\Repositories\Api\V1\TimeSlotRepository;
use App\Models\BookingHour;
use App\Policies\BookingHourPolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginRepositoryInterface::class, LoginRepository::class);
        $this->app->singleton(BookingHourRepositoryInterface::class, BookingHourRepository::class);
        $this->app->singleton(TimeSlotRepositoryInterface::class, TimeSlotRepository::class);
        $this->app->singleton(PersonalDataRepositoryInterface::class, PersonalDataRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(BookingHour::class, BookingHourPolicy::class,);

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
