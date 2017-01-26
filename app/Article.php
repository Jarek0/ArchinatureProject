<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=[
        'title',
        'information_id',
        'content'
    ];

    public function information(){
        return $this->belongsTo('Aska\Information');
    }
}
