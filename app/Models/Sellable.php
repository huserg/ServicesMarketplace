<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sellable extends Model
{

    protected  $primaryKey = 'idSellable';

    protected $fillable = [
        'name', 'description',
    ];

    protected $sellableType = [
        'Service',
        'Product',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function fields() {
        return $this->hasMany('App\Models\Sellable_Fields');
    }

}
