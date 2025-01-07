<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id'
    ];
    // it's supposed to be m2m, fixing these relations in the future

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        //return $this->hasOne('App\Models\Product', 'id', 'product_id');

        return $this->belongsToMany(Product::class, 'cart_product')->withPivot('quantity', 'price')->withTimestamps();
    }
}
