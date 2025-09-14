<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar_img',
        'postcode',
        'address',
        'building',
    ];

    //リレーション
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
