<?php


namespace Modules\DelayReport\Services;


use Modules\Base\Exceptions\CustomException;
use Illuminate\Support\Facades\Http;
use Modules\DelayReport\Events\NewEstimationTimeResolved;
use Modules\Order\Interfaces\DelayReportLockRepositoryInterface;
use Modules\Order\Interfaces\OrderRepositoryInterface;

class ResolveEstimationTime
{
    public function __construct(
        protected EstimateClient $estimateClient,
        protected OrderRepositoryInterface $orderRepository,
        protected DelayReportLockRepositoryInterface $delayReportLockRepository,
    )
    {
        //
    }

    public function get($orderId)
    {
        $order = $this->orderRepository->getByIdWith($orderId, 'trip');

        if ($order->delivery_time >= now()) {
            throw new CustomException('Delay Report is allowed only after the preparation time is over.', 403);
        }

        if ($this->delayReportLockRepository->isLock('order', $orderId)) {
            throw new CustomException('Your order is being reviewed by support.', 409);
        }

        $statuses = [
            'assigned',
            'at_vendor',
            'picked',
        ];

        $time = 0;

        if (!is_null($order->trip) && in_array($order->trip->status, $statuses)) {
            $response = $this->estimateClient->get();

            $time = $response['data']['eta'];
        }

        NewEstimationTimeResolved::dispatch($orderId, $time);

        return $time;

    }


}
