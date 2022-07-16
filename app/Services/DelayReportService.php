<?php


namespace App\Services;


use App\Exceptions\CustomException;
use App\Interfaces\DelayQueueRepositoryInterface;
use App\Interfaces\DelayReportLockRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Http\Resources\OrderResource;

class DelayReportService
{
    /**
     * DelayReportController constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        protected OrderRepositoryInterface $orderRepository,
        protected DelayQueueRepositoryInterface $delayQueueRepository,
        protected DelayReportLockRepositoryInterface $delayReportLockRepository
    )
    {
        //
    }


    public function get($agentId): OrderResource|\Illuminate\Http\JsonResponse
    {
        if ($this->delayReportLockRepository->isLock('agent', $agentId)) {
            throw new CustomException('You already have a report to handle.', 403);
        }

        $orderId = $this->delayQueueRepository->pop();

        if (!$orderId) {
            return new OrderResource([]);
        }

        $this->delayReportLockRepository->lock('agent', $agentId);

        $order = $this->orderRepository->getByIdWith($orderId, 'vendor');

        return new OrderResource($order);
    }

}
