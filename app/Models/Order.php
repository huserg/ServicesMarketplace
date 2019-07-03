<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'price'
    ];

    public function sellable(){
        return $this->belongsTo(Sellable::class);
    }

    public function client() {
        return $this->belongsTo(User::class);
    }

    public function provider() {
        return $this->hasOneThrough(User::class, Sellable::class);
    }

}
