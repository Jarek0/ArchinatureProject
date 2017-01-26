<?php

namespace Aska\Http\Controllers;

use Aska\Meeting;
use Illuminate\Http\Request;
use Aska\Conference;
use Aska\Http\Requests\CreateMeetingRequest;
use Aska\User;
use Session;
use Aska\Poliforum;
use Aska\Presentation;
use Aska\Summary;
use File;
use DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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

        Session::put('option_id', 0);
        return view('conference.users.admin.welcome_panel',compact('conferences'));
    }

    public function users(){
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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
        $students=User::select('id', 'name','surname','email','banned','verified')->where('user_type', '=', 'student')->get();
        $phdstudents=User::select('id', 'name','surname','email','banned','verified')->where('user_type', '=', 'phdstudent')->get();
        $graduates=User::select('id', 'name','surname','email','banned','verified')->where('user_type', '=', 'graduate')->get();
        $guardians=User::select('id', 'name','surname','email','banned','verified')->where('user_type', '=', 'guardian')->get();
        Session::put('option_id', 1);
        return view('conference.users.admin.users',compact('conferences','students','phdstudents','graduates','guardians'));
    }
    public function ban($user_id){

        $user=User::findOrFail($user_id);
            $user->banned=!($user->banned);
            $user->save();
        Session::flash('success','User with id '.$user->id.' is banned/unlock');
        return redirect('admin_panel/users');
    }
    public function verify($user_id){

        $user=User::findOrFail($user_id);
        if(!$user->verified)
        $user->verified=true;
        $user->save();
        Session::flash('success','User with id '.$user->id.' is verified');
        return redirect('admin_panel/users');
    }
    public function showUser($user_id){
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
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
        $user=User::findOrFail($user_id);

        $poliforum=Poliforum::where([['user_id' , '=' , $user_id],['conference_id','=',$conference_id]])->first();
        $presentation=Presentation::where([['user_id' , '=' , $user_id],['conference_id','=',$conference_id]])->first();
        $summary=Summary::where([['user_id' , '=' , $user_id],['conference_id','=',$conference_id]])->first();
        Session::put('option_id', 1);
        return view('conference.users.admin.user',compact('conferences','user','poliforum','presentation','summary'));
    }
    public function delete($user_id){
        $panelText="Delete user";
        return view('conference.users.admin.delete',compact('user_id','panelText'));
    }
    public function destroy($user_id){
        $user=User::findOrFail($user_id);

        $user->delete();
        Session::flash('success','User with id '.$user->id.' is deleted');
        return redirect('admin_panel/users');
    }
    public function files()
    {
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

        $users=DB::table('users')->select('users.id AS id','users.name','users.surname','users.email','presentations.id AS presentation','summaries.id AS summary','poliforums.id AS poliforum')
            ->leftJoin('presentations','presentations.user_id','=','users.id')
            ->leftJoin('summaries','summaries.user_id','=','users.id')
            ->leftJoin('poliforums','poliforums.user_id','=','users.id')
            ->where('presentations.conference_id', '=', $conference_id)
            ->orWhere('summaries.conference_id', '=', $conference_id)
            ->orWhere('poliforums.conference_id', '=', $conference_id)
            ->get();
        Session::put('option_id', 2);
        return view('conference.users.admin.files',compact('conferences','users'));
    }
    public function downloadPresentation($user_id)
    {
        $user=User::findOrFail($user_id);
        $presentation=Presentation::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($presentation===null)
        {
            Session::flash('fail','This user do not have presentation in this conference');
            return redirect('admin_panel/files');
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
    public function deletePresentation($user_id){
        $panelText="Delete presentation";
        return view('conference.users.admin.deletePresentation',compact('panelText','user_id'));
    }
    public function destroyPresentation($user_id){
        $user=User::findOrFail($user_id);
        $presentation=Presentation::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($presentation===null)
        {
            Session::flash('fail','This user do not have presentation in this conference');
            return redirect('admin_panel/files');
        }
        File::delete(public_path(). '\files\presentations\\'.$presentation->path);
        $presentation->delete();
        Session::flash('success','This presentation is deleted');
        return redirect('admin_panel/files');
    }
    public function downloadSummary($user_id)
    {
        $user=User::findOrFail($user_id);
        $summery=Summary::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($summery===null)
        {
            Session::flash('fail','This user do not have summary in this conference');
            return redirect('admin_panel/files');
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
    public function deleteSummary($user_id){
        $panelText="Delete summary";
        return view('conference.users.admin.deleteSummary',compact('panelText','user_id'));
    }
    public function destroySummary($user_id){
        $user=User::findOrFail($user_id);
        $summary=Summary::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($summary===null)
        {
            Session::flash('fail','This user do not have summary in this conference');
            return redirect('admin_panel/files');
        }
        File::delete(public_path(). '\files\summaries\\'.$summary->path);
        $summary->delete();
        Session::flash('success','This summary is deleted');
        return redirect('admin_panel/files');
    }
    public function downloadPoliforum($user_id)
    {
        $user=User::findOrFail($user_id);
        $poliforum=Poliforum::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($poliforum===null)
        {
            Session::flash('fail','This user do not have poliforum in this conference');
            return redirect('admin_panel/files');
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
    public function deletePoliforum($user_id){
        $panelText="Delete poliforum";
        return view('conference.users.admin.deletePoliforum',compact('panelText','user_id'));
    }
    public function destroyPoliforum($user_id){
        $user=User::findOrFail($user_id);
        $poliforum=Poliforum::where('user_id','=',$user->id)->where('conference_id','=',Session::get('conference_id'))->first();
        if($poliforum===null)
        {
            Session::flash('fail','This user do not have poliforum in this conference');
            return redirect('admin_panel/files');
        }
        File::delete(public_path(). '\files\poliforums\\'.$poliforum->path);
        $poliforum->delete();
        Session::flash('success','This poliforum is deleted');
        return redirect('admin_panel/files');
    }
    public function meetings(){
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


        $meetings=DB::table('meetings')->select('meetings.id','meetings.date')
            ->addSelect([DB::raw('count(`users`.`id`) as participants')])
            ->leftJoin('meeting_user', 'meetings.id', '=', 'meeting_user.meeting_id')
            ->leftJoin('users', 'users.id', '=', 'meeting_user.user_id')
            ->where('conference_id','=',$conference_id)
            ->groupBy('meetings.id','meetings.date')
            ->get();
        Session::put('option_id', 3);
        return view('conference.users.admin.meetings',compact('conferences','meetings'));
    }
    public function createMeeting(){
        $panelText="Create meeting";
        return view('conference.users.admin.meeting.create',compact('panelText'));
    }
    public function storeMeeting(CreateMeetingRequest $request){
        $meeting=Meeting::create(['date'=>$request['date'],'conference_id'=>Session::get('conference_id')]);
        Session::flash('success','Meeting on date '.$request['date'].' is created');
        return redirect('admin_panel/meetings');
    }
    public function editMeeting($meeting_id){
        $meeting=Meeting::findOrFail($meeting_id);
        $panelText="Edit meeting";
        return view('conference.users.admin.meeting.edit',compact('meeting','panelText'));
    }
    public function updateMeeting(CreateMeetingRequest $request,$meeting_id){
        $meeting=Meeting::findOrFail($meeting_id);
        $meeting->update($request->all());
        Session::flash('success','Meeting on date '.$request['date'].' is edited');
        return redirect('admin_panel/meetings');
    }
    public function deleteMeeting($meeting_id){
        $panelText="Delete meeting";
        return view('conference.users.admin.meeting.delete',compact('meeting_id','panelText'));
    }
    public function destroyMeeting($meeting_id){
        $meeting=Meeting::findOrFail($meeting_id);

        $meeting->delete();
        Session::flash('success','Meeting is edited');
        return redirect('admin_panel/meetings');
    }
    public function showMeeting($meeting_id){
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
        $meeting=Meeting::findOrFail($meeting_id);
        Session::put('option_id', 3);
        return view('conference.users.admin.meeting.index',compact('conferences','meeting'));
    }
    public function deleteUserFromMeeting($meeting_id,$user_id){
        $panelText="Delete user";
        return view('conference.users.admin.meeting.deleteUser',compact('meeting_id','user_id','panelText'));
    }
    public function destroyUserFromMeeting($meeting_id,$user_id){
        DB::table('meeting_user')
            ->where('user_id','=',$user_id)
            ->where('meeting_id','=',$meeting_id)->delete();
        Session::flash('success','User is deleted from meeting');
        return redirect('admin_panel/meetings/'.$meeting_id);
    }

}
