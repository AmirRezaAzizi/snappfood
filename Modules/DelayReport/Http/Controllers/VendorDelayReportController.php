<?php

namespace Modules\DelayReport\Http\Controllers;


use Illuminate\Routing\Controller;
use Modules\Order\Interfaces\OrderRepositoryInterface;


class VendorDelayReportController extends Controller
{
    private OrderRepositoryInterface $orderRepository;

    /**
     * DelayReportController constructor.
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

    }
}
