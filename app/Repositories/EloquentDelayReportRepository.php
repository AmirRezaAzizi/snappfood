<?php


namespace App\Repositories;


use App\Repositories\EloquentBaseRepository;
use App\Models\DelayReport;
use App\Interfaces\DelayReportRepositoryInterface;

class EloquentDelayReportRepository extends EloquentBaseRepository implements DelayReportRepositoryInterface
{
    public function __construct(DelayReport $delayReport)
    {
        parent::__construct($delayReport);
    }
}
