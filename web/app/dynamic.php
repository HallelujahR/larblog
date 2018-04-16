<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dynamic extends Model
{
    //
    protected $fillable = ['user_id','detail','action'];

    public function getDetailAttribute($value){
        if(!is_object($value)){
            return $this->attributes['detail'] = json_decode($value);
        }else{
            return $this->attributes['detail'];
        }
    }
    
}
