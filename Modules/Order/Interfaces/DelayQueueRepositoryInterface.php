<?php


namespace Modules\Order\Interfaces;


interface DelayQueueRepositoryInterface
{
    public function getList();
    public function push($value);
    public function pop();

}
