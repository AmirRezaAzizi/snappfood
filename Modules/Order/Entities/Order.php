<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Order\Database\factories\OrderFactory;
use Modules\Trip\Entities\Trip;
use Modules\Vendor\Entities\Vendor;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'delivery_time',
    ];

    protected static function newFactory()
    {
        return OrderFactory::new();
    }

    public function trip(): HasOne
    {
        return $this->hasOne(Trip::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }
}
