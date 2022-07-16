<?php

namespace Modules\DelayReport\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\DelayReport\Events\NewEstimationTimeResolved;
use Modules\DelayReport\Listeners\SubmitDelayReport;


class DelayReportEventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        NewEstimationTimeResolved::class => [
            SubmitDelayReport::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
