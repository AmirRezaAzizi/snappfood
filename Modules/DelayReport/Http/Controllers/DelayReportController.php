<?php

namespace Modules\DelayReport\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\DelayReport\Http\Requests\DelayReportRequest;
use Modules\DelayReport\Services\DelayReportService;


class DelayReportController extends Controller
{
    protected DelayReportService $delayReportService;

    public function __construct(DelayReportService $delayReportService)
    {
        $this->delayReportService = $delayReportService;

    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $agentId = 1;

        return $this->delayReportService->get($agentId);
    }

    /**
     * Store a newly created resource in storage.
     * @param DelayReportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DelayReportRequest $request)
    {
        return $this->delayReportService->handle($request->order_id);
    }

}
