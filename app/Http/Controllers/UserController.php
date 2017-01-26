<?php

namespace Aska\Http\Controllers;

use Aska\Conference;
use Aska\Poliforum;
use Aska\Presentation;
use Aska\Summary;
use Aska\Meeting;
use Illuminate\Http\Request;
use Session;
use Auth;
use DB;
use File;
use Aska\Http\Requests\EditUserRequest;
use Aska\Http\Requests\FileUploadRequest;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Session::has('conference_id')){
            return view('conference.users.admin.form2');
        }
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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


        Session::put('option_id', 0);
        return view('conference.users.user.welcome_panel',compact('conferences'));
    }
    public function edit()
    {
        if(!Session::has('conference_id')){
            return view('conference.users.admin.form2');
        }
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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
        $user=Auth::user();

        Session::put('option_id', 1);
        return view('conference.users.user.edit',compact('conferences','user'));
    }
    public function update(EditUserRequest $request){
        $user=Auth::user();
        $user->update($request->all());
        Session::flash('success','Your data is edited');
        return redirect('user_panel');
    }
    public function files()
    {
        if(!Session::has('conference_id')){
            return view('conference.users.admin.form2');
        }
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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
        $poliforum=Poliforum::where([['user_id' , '=' , Auth::user()->id],['conference_id','=',$conference->id]])->first();
        $presentation=Presentation::where([['user_id' , '=' , Auth::user()->id],['conference_id','=',$conference->id]])->first();
        $summary=Summary::where([['user_id' , '=' , Auth::user()->id],['conference_id','=',$conference->id]])->first();

        Session::put('option_id', 2);
        return view('conference.users.user.files',compact('conferences','poliforum','presentation','summary'));
    }


    public function uploadPresentation(FileUploadRequest $request){
        $user=Auth::user();
        $path ='presentation-'. $user->id . '-conference-'.Session::get('conference_id').'.' .$request->file('presentation')->getClientOriginalExtension();

        $request->file('presentation')->move(base_path() . '/public/files/presentations/', $path);
        $presentation=Presentation::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($presentation===null){
        $presentation=Presentation::create(['path'=>$path,'type'=>$request->file('presentation')->getClientOriginalExtension(),'name'=>$request->file('presentation')->getClientOriginalName(),'conference_id'=>Session::get('conference_id'),'user_id'=>$user->id ]);
        }
        else{

            $presentation->update(['path'=>$path,'type'=>$request->file('presentation')->getClientOriginalExtension(),'name'=>$request->file('presentation')->getClientOriginalName()]);
        }
        Session::flash('success','Presentation with name '. $presentation->name .' is uploaded');
        return redirect('user_panel/files');
    }
    public function downloadPresentation()
    {
        $user=Auth::user();
        $presentation=Presentation::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($presentation===null)
        {
            Session::flash('fail','You do not have presentation in this conference');
            return redirect('user_panel/files');
        }
        else{

            $file= public_path(). '\files\presentations\\'.$presentation->path;

            $headers = array(
                'Content-Type: application/'.$presentation->type
            );

            $filename=$presentation->name;
            Session::flash('success','Your download request is accepted');
            return response()->download($file, $filename, $headers);
        }

    }
    public function deletePresentation(){
        $panelText="Delete presentation";
        return view('conference.users.user.deletePresentation',compact('panelText'));
    }
    public function destroyPresentation(){
        $user=Auth::user();
        $presentation=Presentation::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($presentation===null)
        {
            Session::flash('fail','You do not have presentation in this conference');
            return redirect('user_panel/files');
        }
        File::delete(public_path(). '\files\presentations\\'.$presentation->path);
        $presentation->delete();
        Session::flash('success','Your presentation is deleted');
        return redirect('user_panel/files');
    }

    public function uploadSummary(FileUploadRequest $request){
        $user=Auth::user();
        $path ='summary-'. $user->id . '-conference-'.Session::get('conference_id').'.' .$request->file('summary')->getClientOriginalExtension();

        $request->file('summary')->move(base_path() . '/public/files/summaries/', $path);
        $summary=Summary::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($summary===null){
            $summary=Summary::create(['path'=>$path,'type'=>$request->file('summary')->getClientOriginalExtension(),'name'=>$request->file('summary')->getClientOriginalName(),'conference_id'=>Session::get('conference_id'),'user_id'=>$user->id ]);
        }
        else{

            $summary->update(['path'=>$path,'type'=>$request->file('summary')->getClientOriginalExtension(),'name'=>$request->file('summary')->getClientOriginalName()]);
        }
        Session::flash('success','Summary with name '. $summary->name .' is uploaded');
        return redirect('user_panel/files');
    }
    public function downloadSummary()
    {
        $user=Auth::user();
        $summery=Summary::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($summery===null)
        {
            Session::flash('fail','You do not have summary in this conference');
            return redirect('user_panel/files');
        }
        else{

            $file= public_path(). '\files\summaries\\'.$summery->path;

            $headers = array(
                'Content-Type: application/'.$summery->type
            );

            $filename=$summery->name;
            Session::flash('success','Your download request is accepted');
            return response()->download($file, $filename, $headers);
        }

    }
    public function deleteSummary(){
        $panelText="Delete summary";
        return view('conference.users.user.deleteSummary',compact('panelText'));
    }
    public function destroySummary(){
        $user=Auth::user();
        $summary=Summary::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($summary===null)
        {
            Session::flash('fail','You do not have summary in this conference');
            return redirect('user_panel/files');
        }
        File::delete(public_path(). '\files\summaries\\'.$summary->path);
        $summary->delete();
        Session::flash('success','Your summary is deleted');
        return redirect('user_panel/files');
    }


    public function uploadPoliforum(FileUploadRequest $request){
        $user=Auth::user();
        $path ='poliforum-'. $user->id . '-conference-'.Session::get('conference_id').'.' .$request->file('poliforum')->getClientOriginalExtension();

        $request->file('poliforum')->move(base_path() . '/public/files/poliforums/', $path);
        $poliforum=Poliforum::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($poliforum===null){
            $poliforum=Poliforum::create(['path'=>$path,'type'=>$request->file('poliforum')->getClientOriginalExtension(),'name'=>$request->file('poliforum')->getClientOriginalName(),'conference_id'=>Session::get('conference_id'),'user_id'=>$user->id ]);
        }
        else{

            $poliforum->update(['path'=>$path,'type'=>$request->file('poliforum')->getClientOriginalExtension(),'name'=>$request->file('poliforum')->getClientOriginalName()]);
        }
        Session::flash('success','Poliforum with name '. $poliforum->name .' is uploaded');
        return redirect('user_panel/files');
    }
    public function downloadPoliforum()
    {
        $user=Auth::user();
        $poliforum=Poliforum::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($poliforum===null)
        {
            Session::flash('fail','You do not have poliforum in this conference');
            return redirect('user_panel/files');
        }
            else{

                $file= public_path().'\files\poliforums\\'. $poliforum->path;
                $headers = array(
                    'Content-Type: application/'.$poliforum->type
                );

                $filename=$poliforum->name;
                Session::flash('success','Your download request is accepted');
                return response()->download($file, $filename, $headers);
            }

    }
    public function deletePoliforum(){
        $panelText="Delete poliforum";
        return view('conference.users.user.deletePoliforum',compact('panelText'));
    }
    public function destroyPoliforum(){
        $user=Auth::user();
        $poliforum=Poliforum::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($poliforum===null)
        {
            Session::flash('fail','You do not have poliforum in this conference');
            return redirect('user_panel/files');
        }
        File::delete(public_path(). '\files\poliforums\\'.$poliforum->path);
        $poliforum->delete();
        Session::flash('success','Your poliforum is deleted');
        return redirect('user_panel/files');
    }
    public function meetings(){
        if(!Session::has('conference_id')){
            return view('conference.users.admin.form2');
        }
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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
        $meetings=Meeting::select()->where('conference_id','=',Session::get('conference_id'))->get();
        Session::put('option_id', 3);
        return view('conference.users.user.meetings',compact('conferences','meetings'));
    }
    public function acceptMeetings(Request $request){
        $inputs = $request->all();
        $meetings=Meeting::select('id')->where('conference_id','=',Session::get('conference_id'))->get();
        $user=Auth::user();
        foreach ($meetings as $meeting){
                if(array_key_exists ("$meeting->id",$inputs)){
                if(!$meeting->hasUser($user->id))
                $meeting->users()->attach($user);
                }
                else{
                    if($meeting->hasUser($user->id))
                    DB::table('meeting_user')
                    ->where('meeting_id','=',$meeting->id)
                    ->where('user_id','=',Auth::user()->id)->delete();
                }
        }
        return redirect('user_panel/meetings');
    }
    public function contact(){
        if(!Session::has('conference_id')){
            return view('conference.users.admin.form2');
        }
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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

        Session::put('option_id', 4);
        return view('conference.users.contact',compact('conferences'));
    }
}
