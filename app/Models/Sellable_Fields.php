<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sellable_Fields extends Model
{

    protected  $primaryKey = 'idSellableField';

    protected $fillable = [
        'name', 'description', 'field_type', 'value'
    ];

    public function sellable() {
        return $this->belongsTo('App\Models\Sellable');
    }


}
