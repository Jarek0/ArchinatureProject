<?php

namespace Aska\Http\Controllers;

use Aska\Article;
use Aska\Banner;
use Aska\Conference;
use Aska\Http\Requests\CreateConferenceRequest;
use Aska\Information;
use Aska\Sponsor;
use Aska\SponsorCategory;
use Request;
use Session;

class ConferencesController extends Controller
{
    //
    public function index(){
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
            return view('conference.information.article.index');
        }
        $conference=$conferences[0];
        $conference_id=$conference->id;
        Session::put('conference_id', $conference_id);
        $banner=$conference->banner;
        if($banner===null){
            $banner=Banner::create(['conference_id'=>$conference->id,'path'=>'images/banners/default_banner.jpg']);
        }
        $informations=$conference->informations;
        if(count($informations)-1<0){
            Session::flash('fail','Error: any information of conference'.$conference->title.'does not exist');
            return view('conference.information.article.index',compact('conferences'));
        }
        $information=$informations[0];
        $information_id=$information->id;
        Session::put('information_id', $information_id);
        return view('conference.information.article.index',compact('conferences','informations'));
    }

    public function show($conference_id){
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
            return view('conference.information.article.index');
        }
        $conference=ExtrasFunctions::objectFinder($conferences,$conference_id);
        if($conference===null){
            Session::flash('fail','Error: cannot find conference with id='.$conference_id);
            return view('conference.information.article.index',compact('conferences'));
        }
        Session::put('conference_id', $conference_id);
        $banner=$conference->banner;
        if($banner===null){
            $banner=Banner::create(['conference_id'=>$conference->id,'path'=>'images/banners/default_banner.jpg']);
        }
        $informations=$conference->informations;
        if(count($informations)-1<0){
            Session::flash('fail','Error: any information of conference'.$conference->title.'does not exist');
            return view('conference.information.article.index',compact('conferences'));
        }
        $information_id=$informations[0]->id;

        Session::put('information_id', $information_id);
        return view('conference.information.article.index',compact('conferences','informations'));
    }
    public function delete($conference_id){
        $conference=Conference::findOrFail($conference_id);
        $panelText="Delete conference";
        return view('conference.delete',compact('conference_id','panelText'));
    }
    public function create(){
        $panelText="Create conference";
        return view('conference.create')->with('panelText',$panelText);
    }

    public function store(CreateConferenceRequest $request){
        $conference=Conference::create($request->all());
        $banner=Banner::create(['conference_id'=>$conference->id,'path'=>'images/banners/default_banner.jpg']);
        $information=Information::create(['conference_id'=>$conference->id,'title'=>'Default']);
        $sponsors_category=SponsorCategory::create(['conference_id'=>$conference->id,'name'=>'Default']);
        $sponsor=Sponsor::create(['sponsor_category_id'=>$sponsors_category->id,'name'=>'Default','image_path'=>'images/logos/default_logo.png','website_link'=>'http://www.pollub.pl/']);
        $article=Article::create(['information_id'=>$information->id,'title'=>'Default','content'=>'Default Content']);
        Session::flash('success','Conference '.$conference->title.' is created');
        return redirect('conferences/'.$conference->id.'/informations/'.$information->id.'/articles/'.$article->id);
    }

    public function destroy($conference_id){
        $conference = Conference::findOrFail($conference_id);
        if(Conference::count()<=1){
            Session::flash('fail','Conference '.$conference->title.' is only one conference and it can not be deleted');
            return redirect('conferences');
        }

        $conference->delete();
        Session::flash('success','Conference '.$conference->title.' is deleted');
        return redirect('conferences');
    }

    public function edit($conference_id){
        $conference=Conference::findOrFail($conference_id);
        $panelText="Edit conference";
        return view('conference.edit',compact('conference','panelText'));
    }
    public function update(CreateConferenceRequest $request,$conference_id){
        $conference=Conference::findOrFail($conference_id);
        $conference->update($request->all());
        Session::flash('success','Conference '.$conference->title.' is edited');
        return redirect('conferences/'.$conference->id);
    }
}
