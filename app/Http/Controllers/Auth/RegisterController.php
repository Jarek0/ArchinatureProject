<?php

namespace Aska\Http\Controllers\Auth;

use Aska\User;
use Validator;
use Aska\Http\Controllers\Controller;
use Aska\Http\Requests\PreRegistrationRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Aska\Conference;
use Illuminate\Support\Facades\Auth;
use Aska\Http\Controllers\ExtrasFunctions;
use Illuminate\Auth\Events\Registered;
use Aska\Mail\ConfirmationEmail;
use Session;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation'=>'required|min:6',
            'name' => 'required|max:30',
            'surname' => 'required|max:30',
            'phone' => 'required|min:9|max:11|regex:/^[0-9]+$/',
            'school' => 'required|max:100',
            'user_type'=>'required|in:student,phdstudent,graduate,guardian',
            'accompanying_person'=>'required|in:1,0',
            'accompanying_person_name' => 'min:3|max:30',
            'accompanying_person_surname' => 'min:3|max:30',
            'accompanying_person_email' => 'email|max:255',
            'school_field_of_study' => 'min:3|max:30',
            'refer_theme' => 'required|min:3|max:50',
            'school_degree'=>'min:3|max:30',
            'science_club'=>'in:1,0',
            'science_club_name' => 'min:1|max:50',
            'science_club_email' => 'email|max:255',
            'science_club_page' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/|max:255',
            'science_club_function'=>'in:member,board_member,chairman',
            'science_club_guardian' => 'min:1|max:70',
            'science_club_information' => 'min:1|max:100',
            'employee_universities'=>'in:1,0',
            'facture'=>'in:1,0',
            'facture_information'=>'min:3|max:255',
            'company'=>'in:1,0',
            'company_profile' => 'min:1|max:50',
            'company_name' => 'min:1|max:50',
            'company_nip' => 'size:10|min:9|max:11|regex:/^[0-9]+$/',
            'school_institute' => 'min:1|max:50',
            'school_establishment' => 'min:1|max:50',
            'accept'=>'required',
        ]);
    }

    protected function extractFromArray($key,$array){
        return array_key_exists ($key,$array) ? $array[$key] : null;
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'school' => $data['school'],
            'user_type' => $data['user_type'],
            'accompanying_person' => $data['accompanying_person'],
            'accompanying_person_name' => $this->extractFromArray('accompanying_person_name',$data),
            'accompanying_person_surname' => $this->extractFromArray('accompanying_person_surname',$data),
            'accompanying_person_email' => $this->extractFromArray('accompanying_person_email',$data),
            'school_field_of_study' => $this->extractFromArray('school_field_of_study',$data),
            'refer_theme' => $data['refer_theme'],
            'school_degree' => $this->extractFromArray('school_degree',$data),
            'science_club' => $this->extractFromArray('science_club',$data),
            'science_club_name' => $this->extractFromArray('science_club_name',$data),
            'science_club_email' => $this->extractFromArray('science_club_email',$data),
            'science_club_page' => $this->extractFromArray('science_club_page',$data),
            'science_club_function' => $this->extractFromArray('science_club_function',$data),
            'science_club_guardian' => $this->extractFromArray('science_club_guardian',$data),
            'science_club_information' => $this->extractFromArray('science_club_information',$data),
            'facture' => $this->extractFromArray('facture',$data),
            'facture_information' => $this->extractFromArray('facture_information',$data),
            'company' => $this->extractFromArray('company',$data),
            'company_profile' => $this->extractFromArray('company_profile',$data),
            'company_name' => $this->extractFromArray('company_name',$data),
            'company_nip' => $this->extractFromArray('company_nip',$data),
            'school_institute' => $this->extractFromArray('school_institute',$data),
            'school_establishment' => $this->extractFromArray('school_establishment',$data),
            'employee_universities' => $this->extractFromArray('employee_universities',$data),
            'last_logged'=>date('Y-m-d H:i:s')
        ]);
    }



    public function showRegistrationForm(PreRegistrationRequest $request)
    {

        return redirect('/show/register/'.$request['user_type']);
    }
    public function showRegistrationFormGet($user_type)
    {
        if($user_type===null){
            return redirect('preRegister');
        }
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
        return view('conference.users.register',compact('conferences','informations','user_type'));
    }

    public function showPreRegistrationForm()
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
        return view('conference.users.pre-register',compact('conferences','informations'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

     /*  $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath()); */

        Mail::to($user->email)->send(new ConfirmationEmail($user));

        return back()->with('status','Please check you e-mail box to confirm your account. If you did now get confirmation e-mail from us, please try to login using your e-mail and password to resend confirmation e-mail');
    }

    public function confirmEmail($token){
        User::whereToken($token)->firstOrFail()->hasVerified();

        return redirect('login')->with('status','You are now confirmed. Please login.');
    }


    protected function guard()
    {
        return Auth::guard();
    }
}
