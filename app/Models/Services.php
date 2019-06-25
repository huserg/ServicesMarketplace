<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected  $primaryKey = 'idService';

    protected $fillable = [
        'name', 'description',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }


}
