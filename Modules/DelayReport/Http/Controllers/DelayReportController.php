<?php

namespace Modules\DelayReport\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Base\Traits\ApiResponse;
use Modules\DelayReport\Http\Requests\DelayReportRequest;
use Modules\DelayReport\Services\DelayReportService;
use Modules\DelayReport\Services\ResolveEstimationTime;


class DelayReportController extends Controller
{
    use ApiResponse;

    public function __construct(protected ResolveEstimationTime $resolveEstimationTime, protected DelayReportService $delayReportService)
    {
        //
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $agentId = 1;

        return  $this->delayReportService->get($agentId);
    }

    /**
     * Store a newly created resource in storage.
     * @param DelayReportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DelayReportRequest $request)
    {
        $time = $this->resolveEstimationTime->get($request->order_id);

        if ($time) {
            $message = "Your order will reach you in $time minutes.";
        } else {
            $message = "Your order has been queued for review by support team.";
        }

        return $this->success([], $message);
    }

}
