<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DelayReport extends Model
{
    use HasFactory;

    public const STATUSES = [
        'new_estimated', // new delivery time estimated and returned
        'pending',       // report was queued for review by agents
    ];

    protected $fillable = [
        'order_id',
        'status'
    ];

}
