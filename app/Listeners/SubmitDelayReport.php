<?php


namespace App\Listeners;


use App\Exceptions\CustomException;
use App\Events\NewEstimationTimeResolved;
use App\Interfaces\DelayReportRepositoryInterface;
use App\Interfaces\DelayQueueRepositoryInterface;

class SubmitDelayReport
{
    public function __construct(
        protected DelayQueueRepositoryInterface $delayQueueRepository,
        protected DelayReportRepositoryInterface $delayReportRepository
    )
    {
        //
    }

    /**
     * @throws CustomException
     */
    public function handle(NewEstimationTimeResolved $event)
    {
        $time = $event->time;

        if (! $time){

            try {
                $this->delayQueueRepository->push($event->orderId);
            } catch (\Exception $e) {
                throw new CustomException("Your order is already in the queue.", 409);
            }

            $status = 'pending';
        }else{
            $status = 'new_estimated';
        }

        $this->createDelayReportWithStatus($event->orderId, $status);
    }

    protected function createDelayReportWithStatus($order_id, $status): void
    {
        $delayReport['status'] = $status;
        $delayReport['order_id'] = $order_id;

        $this->delayReportRepository->create($delayReport);
    }
}
