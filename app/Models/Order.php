<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'rec_address',
        'phone',
        'user_id',
        'order_total'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
