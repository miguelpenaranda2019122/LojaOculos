<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function oculo()
    {
        return $this->belongsTo(Oculo::class);
    }
}
