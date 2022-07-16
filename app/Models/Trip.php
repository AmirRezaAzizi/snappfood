<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Order;

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
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
