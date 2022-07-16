<?php


namespace Modules\Order\Repositories;


use Illuminate\Support\Facades\Redis;
use Modules\Order\Interfaces\DelayReportLockRepositoryInterface;

class RedisReportLockRepository implements DelayReportLockRepositoryInterface
{
    private string $prefix = 'delay_report';

    public function lock($entity, $value)
    {
        return Redis::set($this->getKey($entity, $value), true);
    }

    public function isLock($entity, $value): bool
    {
        return Redis::exists($this->getKey($entity, $value));
    }

    private function getKey($entity, $value): string
    {
        return "{$this->prefix}_{$entity}_{$value}";
    }
}
