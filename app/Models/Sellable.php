<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sellable extends Model
{

    protected $fillable = [
        'name', 'description', 'price', 'image', 'type',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function fields() {
        return $this->hasMany('App\Models\SellableField');
    }

}
