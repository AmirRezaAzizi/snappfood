<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\DelayReportRepositoryInterface;
use App\Repositories\EloquentDelayReportRepository;
use App\Interfaces\DelayQueueRepositoryInterface;
use App\Interfaces\DelayReportLockRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Repositories\EloquentOrderRepository;
use App\Repositories\RedisDelayQueueRepository;
use App\Repositories\RedisReportLockRepository;
use App\Models\Trip;
use App\Observers\TripObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        $this->app->singleton(DelayQueueRepositoryInterface::class, RedisDelayQueueRepository::class);
        $this->app->singleton(DelayReportLockRepositoryInterface::class, RedisReportLockRepository::class);
        $this->app->singleton(DelayReportRepositoryInterface::class, EloquentDelayReportRepository::class);
        $this->app->register(\App\Providers\RouteServiceProvider::class);
        $this->app->register(DelayReportEventServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Trip::observe(TripObserver::class);
    }
}
