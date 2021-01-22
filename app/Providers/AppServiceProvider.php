<?php

namespace App\Providers;

use App\Repositories\Appointment\AppointmentRepository;
use App\Repositories\Appointment\AppointmentRepositoryInterface;
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
