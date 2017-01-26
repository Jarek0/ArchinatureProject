<?php

namespace Aska\Http\Controllers\Auth;

use Aska\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Aska\Conference;
use Aska\Banner;
use Aska\Http\Controllers\ExtrasFunctions;
use Illuminate\Http\Request;
use Session;
use Aska\Mail\ConfirmationEmail;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\Lang;

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
    protected $redirectTo = 'user_panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {

        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist, create new conference');
            return redirect('conferences');
        }
        if(!Session::has('conference_id')){
            Session::flash('fail','Error: conference id do not exist, create new conference');
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
            return redirect('conferences/'.$conference_id);
        }
        return view('conference.users.user.form',compact('conferences','informations'));
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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        $user=$this->guard()->user();
        if (!$user->verified) {
            auth()->logout();
            $user->token = str_random(40);
            $user->save();
            Mail::to($user->email)->send(new ConfirmationEmail($user));
            return back()->with('status', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        if($user->banned){
            auth()->logout();
            return back()->with('status', 'Your account was locked by admin. If you want unlock your account, please contact with admin by e-mail: jarosław.bielec@pollub.edu.pl');
        }
        $user->last_logged=date('Y-m-d H:i:s');
        $user->save();
        return redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard();
    }

}
