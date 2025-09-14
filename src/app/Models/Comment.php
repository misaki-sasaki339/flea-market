<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'review'
    ];

    //リレーション
    public function User(){
        return $this->belongsTo('App\Models\User');
    }

    public function Item(){
        return $this->belongsTo('App\Models\Item');
    }
}
