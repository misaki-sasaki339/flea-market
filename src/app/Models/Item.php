<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_img',
        'condition',
        'item_name',
        'bland_name',
        'description',
        'price'
    ];

    //リレーション
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
}
