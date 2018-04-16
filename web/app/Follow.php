<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //制定操作的表明
    protected $table='user_question';

    protected $fillable = ['user_id','question_id'];
}
