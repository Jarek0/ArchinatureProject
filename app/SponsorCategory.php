<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class SponsorCategory extends Model
{
    protected $fillable=[
        'name',
        'conference_id'
    ];

    public function conference(){
        return $this->belongsTo('Aska\Conference');
    }
    public function sponsors(){
        return $this->hasMany('Aska\Sponsor');
    }
}
