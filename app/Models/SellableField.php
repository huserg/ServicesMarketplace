<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellableField extends Model
{

    protected $fillable = [
        'name', 'description', 'input_type', 'attributes', 'value'
    ];

    public function sellable() {
        return $this->belongsTo('App\Models\Sellable');
    }


}
