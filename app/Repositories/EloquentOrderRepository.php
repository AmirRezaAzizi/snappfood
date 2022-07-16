<?php


namespace App\Repositories;


use App\Repositories\EloquentBaseRepository;
use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class EloquentOrderRepository extends EloquentBaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }


}
