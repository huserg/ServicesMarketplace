<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'price'
    ];

    public function sellable(){
        return $this->belongsTo(Sellable::class);
    }

    public function client() {
        return $this->belongsTo(User::class);
    }

}
