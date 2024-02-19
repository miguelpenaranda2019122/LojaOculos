<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itemsCart()
    {
        return $this->hasMany(ItemsCart::class);
    }
}
