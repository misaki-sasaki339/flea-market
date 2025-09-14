<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_postcode',
        'shipment_address',
        'shipment_building'
    ];

    //リレーション
    public function Order(){
        return $this->belongsTo('App\Models\Order');
    }

}
