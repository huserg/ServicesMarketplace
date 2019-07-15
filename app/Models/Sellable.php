<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sellable extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'price', 'image', 'type',
    ];

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function fields() {
        return $this->MorphMany(SellableField::class, 'fieldable');
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

}
