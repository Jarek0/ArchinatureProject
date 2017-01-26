<?php

namespace Aska;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','verified','banned','last_logged','created_at','updated_at', 'email', 'password','surname','phone','user_type','school','school_field_of_study','school_institute',
        'school_establishment','school_degree','science_club','science_club_name','science_club_email','science_club_page',
        'science_club_function','science_club_guardian','science_club_information','accompanying_person','accompanying_person_name',
        'accompanying_person_surname','accompanying_person_email','company','company_profile','company_name','company_address',
        'company_nip','facture','facture_information','employee_universities','refer_theme','last_logged'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot(){
        parent::boot();

        static::creating(function ($user){
            $user->token = str_random(40);
        });
    }

    public function hasVerified(){
        $this->verified=true;
        $this->token=null;
        $this->save();
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
    public function meetings(){
        return $this->belongsToMany('Aska\Meeting');
    }
}
