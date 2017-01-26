<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable=[
        'path',
        'conference_id'
    ];

    public function conference(){
        return $this->belongsTo('Aska\Conference');
    }
}
