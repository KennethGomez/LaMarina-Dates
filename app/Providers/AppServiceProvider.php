<?php

namespace App\Providers;

use App\Repositories\Appointment\AppointmentRepository;
use App\Repositories\Appointment\AppointmentRepositoryInterface;
use App\Repositories\Date\DateRepository;
use App\Repositories\Date\DateRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(DateRepositoryInterface::class, DateRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
