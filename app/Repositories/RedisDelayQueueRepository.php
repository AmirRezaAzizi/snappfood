<?php


namespace App\Repositories;


use Illuminate\Support\Facades\Redis;
use App\Interfaces\DelayQueueRepositoryInterface;

class RedisDelayQueueRepository implements DelayQueueRepositoryInterface
{
    private string $key = 'order_delay_reports';

    /**
     * @param $value
     * @return bool|\Exception
     * @throws \Exception
     */
    public function push($value): bool|\Exception
    {
        // check if not add duplicate item to the queue
        if ($this->queueHasKey($value)) {
            throw new \Exception();
        }

        return Redis::rpush($this->key, $value);
    }

    /**
     * @return mixed
     */
    public function pop(): int
    {
        return Redis::lpop($this->key);
    }

    /**
     * @return mixed
     */
    public function getList(): array
    {
        return Redis::lRange($this->key, 0, -1);
    }

    /**
     * @return mixed
     */
    public function deleteList(): bool
    {
        return Redis::del($this->key);
    }

    protected function queueHasKey($value): bool
    {
        return in_array($value, $this->getList());
    }

}
