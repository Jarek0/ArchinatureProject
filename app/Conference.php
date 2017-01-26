<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    //
    protected $fillable=[
        'title',
    ];
    public function informations(){
        return $this->hasMany('Aska\Information');
    }
    public function banner(){
        return $this->hasOne('Aska\Banner');
    }
    public function sponsorsCategories(){
        return $this->hasMany('Aska\SponsorCategory');
    }
    public function summaries(){
        return $this->hasMany('Aska\Summary');
    }
    public function poliforums(){
        return $this->hasMany('Aska\Poliforum');
    }
    public function presentations(){
        return $this->hasMany('Aska\Presentation');
    }
}
