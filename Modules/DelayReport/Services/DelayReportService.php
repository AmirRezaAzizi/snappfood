<?php


namespace Modules\DelayReport\Services;


use Modules\Base\Exceptions\CustomException;
use Modules\Order\Interfaces\DelayQueueRepositoryInterface;
use Modules\Order\Interfaces\DelayReportLockRepositoryInterface;
use Modules\Order\Interfaces\OrderRepositoryInterface;
use Modules\Order\Transformers\OrderResource;

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
