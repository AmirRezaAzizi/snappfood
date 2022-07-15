<?php

namespace Modules\Trip\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Order\Entities\Order;

class Trip extends Model
{
    use HasFactory;

    public const STATUSES = [
        'assigned',
        'at_vendor',
        'picked',
        'delivered',
    ];

    protected $fillable = [
        'order_id',
        'status',
        'last_status_time',
    ];

    protected static function newFactory()
    {
        return \Modules\Trip\Database\factories\TripFactory::new();
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
