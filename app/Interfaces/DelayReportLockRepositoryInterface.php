<?php


namespace App\Interfaces;


interface DelayReportLockRepositoryInterface
{
    public function lock($entity, $value);
    public function isLock($entity, $value);
}
