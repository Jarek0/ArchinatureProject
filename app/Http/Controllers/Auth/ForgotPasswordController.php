<?php

namespace Aska\Http\Controllers\Auth;

use Aska\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Aska\Conference;
use Illuminate\Http\Request;
use Aska\Banner;
use Aska\Http\Controllers\ExtrasFunctions;
use Illuminate\Support\Facades\Password;
use Session;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
            return redirect('conferences');
        }
        if(!Session::has('conference_id')){
            Session::flash('fail','Error: conference id do not exist');
            return redirect('conferences');
        }
        $conference_id=Session::get('conference_id');
        $conference=ExtrasFunctions::objectFinder($conferences,$conference_id);
        if($conference===null){
            Session::flash('fail','Error: cannot find conference with id='.$conference_id);
            return redirect('conferences/'.$conference_id);
        }
        $banner=$conference->banner;
        if($banner===null){
            $banner=Banner::create(['conference_id'=>$conference->id,'path'=>'images/banners/default_banner.jpg']);
        }
        $informations=$conference->informations;
        if(count($informations)-1<0){
            Session::flash('fail','Error: any information of conference'.$conference->title.'does not exist');
            return redirect('conferences/'.$conference_id);
        }
        if(!Session::has('information_id')){
            Session::flash('fail','Error: information id do not exist');
            return redirect('conferences/'.$conference_id);
        }
        $information_id=Session::get('information_id');
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.'of conference '.$conference->title);
            return redirect('conferences/'.$conference_id.'/informations/'.$information_id);
        }
        return view('conference.users.email',compact('conferences','informations'));
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('users');
    }


}
