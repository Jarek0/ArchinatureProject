<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable=[
        'date',
        'conference_id',
    ];
    public function conference(){
        return $this->belongsTo('Aska\Conference');
    }

    public function users(){
        return $this->belongsToMany('Aska\User');
    }

    public function hasUser($user_id){
        foreach($this->users()->get() as $user) {
            if ($user_id == $user->id) {
                return true;
            }
        }
        return false;
    }
}
