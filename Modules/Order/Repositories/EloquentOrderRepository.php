<?php


namespace Modules\Order\Repositories;


use Modules\Base\Repositories\EloquentBaseRepository;
use Modules\Order\Entities\Order;
use Modules\Order\Interfaces\OrderRepositoryInterface;

class EloquentOrderRepository extends EloquentBaseRepository implements OrderRepositoryInterface
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }


}
