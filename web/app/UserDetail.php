<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserDetail extends Model
{
    //
    protected $fillable = [
        'user_id','sex', 'introduce', 'domicile','industry','career','experience','individual','cover'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
