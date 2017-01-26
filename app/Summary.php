<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable=[
        'type',
        'path',
        'name',
        'conference_id',
        'user_id',
        'updated_at'
    ];
    public function conference(){
        return $this->belongsTo('Aska\Conference')->withTrashed();
    }
    public function user(){
        return $this->belongsTo('Aska\User')->withTrashed();
    }
}
