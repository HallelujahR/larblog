<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmation_token','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function questions(){
        return $this ->hasMany('\App\Question');
    }

    public function user_details(){
        return $this->belongsTo('App\UserDetail');
    }

    public function owns(){
        return $this->id == $question->user_id;
    }

    public function answers() {
        return $this -> hasMany('\App\Answer');
    }

    public function follows(){

        return $this->belongsToMany('App\Question','user_question')->withTimestamps();

    }

    public function followThis($question_id){
        
        // Follow::where('question_id',$question_id)->where('user_id',$this->id)->count();
        return $this->follows()->toggle($question_id);
    }

    public function followed($question_id){
        return Follow::where('question_id',$question_id)->where('user_id',$this->id)->count();
    }

    public function follows_user(){
        return $this->belongsToMany(self::class,'follows','follower_id','followed_id')->withTimestamps();
    }

    public function follows_topic(){
        return $this->belongsToMany(self::class,'follows','follower_id','followed');
    }

    public function followings_user(){
        return $this->belongsToMany(self::class,'follows','followed_id','follower_id')->withTimestamps();
    }
    public function followThis_user($user_id){
        return $this->follows_user()->toggle($user_id);
    }


    public function followed_user($user_id){
        $arr = Auth::user()->follows_user()->pluck('followed_id')->toArray();
        if(in_array($user_id,$arr)){
            return true;
        }else{
            return false;
        }
    }

    public function detail(){
        return $this->hasOne('\App\UserDetail');
    }

    public function images(){
        return $this->hasOne('\App\Image');
    }

    public function messages(){
    
        return $this->hasMany('App\Message','to_user_id')->withTimestamps();

    
    }


    public function comments(){
        return $this ->hasMany('\App\Comment');
    }


    public function follows_topicc(){
        return $this->belongsToMany('App\Topic','user_topics')->withTimesTamps();
    }

    public function followed_topic($topic_id){
        return user_topic::where('topic_id',$topic_id)->where('user_id',$this->id)->count();
    }

    public function followeTopicThis($topic_id){
        return $this->follows_topicc()->toggle($topic_id);
    }
}
