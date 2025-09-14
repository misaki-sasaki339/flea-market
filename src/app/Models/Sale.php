<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    //リレーション
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
    public function Item(){
        return $this->belongsTo('App\Models\Item');
    }
}
