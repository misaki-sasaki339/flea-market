<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'postcode',
        'address',
        'building'
    ];

    //リレーション
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }

}
