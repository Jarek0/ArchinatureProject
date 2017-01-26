<?php

namespace Aska;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable=[
        'sponsor_category_id',
        'website_link',
        'image_path'
    ];

    public function sponsorCategories(){
        return $this->belongsTo('Aska\SponsorCategory');
    }
}
