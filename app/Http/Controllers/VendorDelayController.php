<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use Illuminate\Routing\Controller;
use App\Models\Vendor;

class VendorDelayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return VendorResource
     */
    public function index(): VendorResource
    {
        $vendors = Vendor::query()
            ->join('orders', 'orders.vendor_id', '=', 'vendors.id')
            ->whereNotNull('orders.delivery_time')
            ->whereNotNull('orders.delivered_at')
            ->selectRaw('vendors.id, vendors.name, SUM(TIMESTAMPDIFF(MINUTE,orders.delivery_time,orders.delivered_at)) AS minutes')
            ->orderByRaw('minutes DESC')
            ->groupBy('orders.vendor_id')
            ->paginate(request('paginate'));

        return new VendorResource($vendors);
    }
}
