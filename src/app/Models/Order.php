<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment'
    ];

    //リレーション
    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function Shipments(){
        return $this->hasOne('App\Models\Shipment');
    }
}
