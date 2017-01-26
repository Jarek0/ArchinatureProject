<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable=[
        'title',
        'conference_id'
    ];

    public function conference(){
        return $this->belongsTo('Aska\Conference');
    }
    public function articles(){
        return $this->hasMany('Aska\Article');
    }
}
