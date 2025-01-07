<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'category_id',
        'quantity',
    ];

    public function categories()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class, 'cart_product')->withPivot('quantity', 'price')->withTimestamps();
    }
}
