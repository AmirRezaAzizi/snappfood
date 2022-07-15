<?php


namespace Modules\DelayReport\Repositories;


use Modules\Base\Repositories\EloquentBaseRepository;
use Modules\DelayReport\Entities\DelayReport;
use Modules\DelayReport\Interfaces\DelayReportRepositoryInterface;

class EloquentDelayReportRepository extends EloquentBaseRepository implements DelayReportRepositoryInterface
{
    public function __construct(DelayReport $delayReport)
    {
        parent::__construct($delayReport);
    }
}
