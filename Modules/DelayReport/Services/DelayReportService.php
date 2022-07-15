<?php


namespace Modules\DelayReport\Services;


use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Modules\DelayReport\Entities\DelayReport;
use Modules\DelayReport\Interfaces\DelayReportRepositoryInterface;
use Modules\Order\Interfaces\DelayQueueRepositoryInterface;
use Modules\Order\Interfaces\OrderRepositoryInterface;

class DelayReportService
{
    private OrderRepositoryInterface $orderRepository;
    private DelayQueueRepositoryInterface $delayQueueRepository;
    private DelayReportRepositoryInterface $delayReportRepository;

    /**
     * DelayReportController constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository, DelayQueueRepositoryInterface $delayQueueRepository, DelayReportRepositoryInterface $delayReportRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->delayQueueRepository = $delayQueueRepository;
        $this->delayReportRepository = $delayReportRepository;
    }

    public function handle($orderId)
    {
        $order = $this->orderRepository->with('trip')->getById($orderId);

        if ($order->delivery_time >= now()) {
            throw new CustomException('اعلام تاخیر فقط پس از اتمام زمان آماده سازی مجاز است.', 403);
        }

        $delayReport = [];
        $delayReport['order_id'] = $order->id;

        $statuses = [
            'assigned',
            'at_vendor',
            'picked',
        ];

        if (!is_null($order->trip) && in_array($order->trip->status, $statuses)) {

            $response = Http::get('https://run.mocky.io/v3/122c2796-5df4-461c-ab75-87c1192b17f7')->json();
            // TODO: handle API error

            $delayReport['status'] = 'new_estimated';
            $delayReport = $this->delayReportRepository->create($delayReport);

            return response()->json([
                'message' => "سفارش شما تا {$response['data']['eta']} دقیقه دیگر به دستتان می رسد."
            ]);

        }

        // check if not add duplicate order to the queue
        $queue = $this->delayQueueRepository->getList();

        if (in_array($order->id, $queue)) {
            throw new CustomException("سفارش شما در صف بررسی توسط پشتیبانی است.", 409);
        }

        // check if other agent is working on the order
        $orderKey = "order-delay-order-$order->id";
        if (Cache::has($orderKey)) {
            throw new CustomException( "سفارش شما درحال بررسی توسط پشتیبان است.", 409);
        }

        // Add the order to queue
        $this->delayQueueRepository->push($order->id);

        $delayReport['status'] = 'pending';

        $delayReport = $this->delayReportRepository->create($delayReport);

        return response()->json([
            'message' => "سفارش شما در صف بررسی توسط پشتیبانی قرار گرفت."
        ]);
    }

    public function get($agentId)
    {
        // Each agent can have only one order to check
        $agentKey = "order-delay-agent-$agentId";
        if (Cache::has($agentKey)) {
            throw new CustomException('شما یک گزارش تاخیر در حال بررسی دارید.', 403);
        }

        $orderId = $this->delayQueueRepository->pop();

        if (!$orderId) {
            return response()->json([
                'message' => "هیچ گزارش تاخیری جهت بررسی وجود ندارد."
            ]);
        }

        Cache::put($agentKey, $orderId);

        $orderKey = "order-delay-order-$orderId";
        Cache::put($orderKey, $agentKey);

        return $this->orderRepository->with('vendor')->getById($orderId);
    }

}
