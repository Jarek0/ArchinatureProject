<?php

namespace Aska\Http\Controllers\AdminAuth;

use Aska\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Aska\Conference;
use Aska\Banner;
use Aska\Http\Controllers\ExtrasFunctions;
use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin_panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $user = \Auth::user();

    }

    public function showLoginForm()
    {
        if(!Session::has('conference_id')){
            return view('conference.users.admin.form2');
        }
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            return view('conference.users.admin.form2');
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
        return view('conference.users.admin.form',compact('conferences','informations'));
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        if(!Session::has('conference_id')){
            return redirect('conferences');
        }
        return redirect('conferences/'.Session::get('conference_id'));
    }


    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
