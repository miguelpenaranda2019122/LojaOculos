<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsCart extends Model
{
    use HasFactory;

    protected $table = 'items_cart';

    public function shoppingCart()
    {
        return $this->belongsTo(ShoppingCart::class);
    }

    public function oculo()
    {
        return $this->belongsTo(Oculo::class);
    }
}
