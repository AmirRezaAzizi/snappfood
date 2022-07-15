<?php


namespace Modules\Order\Repositories;


use Illuminate\Support\Facades\Redis;
use Modules\Order\Interfaces\DelayQueueRepositoryInterface;

class RedisDelayQueueRepository implements DelayQueueRepositoryInterface
{
    private $key = 'order-delay-reports';

    public function push($value)
    {
        return Redis::rpush($this->key, $value);
    }

    public function pop()
    {
        return Redis::lpop($this->key);
    }

    public function getList()
    {
        return Redis::lRange($this->key, 0, -1);
    }

    public function deleteList()
    {
        return Redis::del($this->key);
    }
}
