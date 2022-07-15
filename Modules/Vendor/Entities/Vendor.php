<?php

namespace Modules\Vendor\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\Entities\Order;
use Modules\Vendor\Database\factories\VendorFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected static function newFactory()
    {
        return VendorFactory::new();
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
