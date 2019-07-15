<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'price', 'cancelled_at'
    ];

    public function sellable(){
        return $this->belongsTo(Sellable::class);
    }

    public function client() {
        return $this->belongsTo(User::class);
    }

    public function fields() {
        return $this->MorphMany(SellableField::class, 'fieldable');
    }

}
