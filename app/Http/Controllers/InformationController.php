<?php

namespace Aska\Http\Controllers;

use Aska\Information;
use Aska\Conference;
use Aska\Article;
use Aska\Http\Requests\CreateInformationRequest;
use Request;
use Session;

class InformationController extends Controller
{

    public function show($conference_id,$information_id){
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
        }        $informations=$conference->informations;
        if(count($informations)-1<0){
            Session::flash('fail','Error: any information of conference'.$conference->title.'does not exist');
            return view('conference.information.article.index',compact('conferences'));
        }
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.'of conference '.$conference->title);
            return view('conference.information.article.index',compact('conferences','informations'));
        }
        Session::put('information_id', $information_id);
        return view('conference.information.article.index',compact('conferences','informations'));
    }
    public function index($conference_id){
        $conferences=Conference::latest()->get();
        if(count($conferences)-1<0){
            Session::flash('fail','Error: any conference does not exist');
            return view('conference.information.article.index');
        }
        $conference=ExtrasFunctions::objectFinder($conferences,$conference_id);
        if($conference===null){
            Session::flash('fail','Error: cannot find conference with id='.$conference_id);
            return view('conference.information.article.index','conferences');
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

    public function create($conference_id){
        $conference=Conference::findOrFail($conference_id);
        $panelText="Create information";
        return view('conference.information.create',compact('panelText','conference_id'));
    }
    public function store($conference_id,CreateInformationRequest $request){
        $conference=Conference::findOrFail($conference_id);
        if(count($conference->informations)>=7){
            Session::flash('fail','Conferencion' .$conference->title. ' can have only seven information');
            return redirect('conferences/'.$conference_id);
        }
        $information=Information::create(['conference_id'=>$conference->id,'title'=>$request['title']]);
        $article=Article::create(['information_id'=>$information->id,'title'=>'Default','content'=>'Default Content']);
        Session::flash('success','Information '.$information->title.' of ' .$conference->title. ' is created');
        return redirect('conferences/'.$conference_id.'/informations/'.$information->id.'/articles/'.$article->id);
    }
    public function edit($conference_id,$information_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Edit information";
        return view('conference.information.edit',compact('information','panelText','conference_id'));
    }
    public function update(CreateInformationRequest $request,$conference_id,$information_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $information->update($request->all());
        Session::flash('success','Information '.$information->title.' of ' .$conference->title. ' is edited');
        return redirect('conferences/'.$conference_id.'/informations/'.$information_id);
    }
    public function delete($conference_id,$information_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Delete information";
        return view('conference.information.delete',compact('information_id','panelText','conference_id'));
    }
    public function destroy($conference_id,$information_id){
        $conference = Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if(count($informations)<=1){
            Session::flash('fail','Information '.$information->title.' is only one information of conference '.$conference->title.' and it can not be deleted');
            return redirect('conferences/'.$conference_id.'/informations/'.$information_id);
        }
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $information->delete();
        Session::flash('success','Information '.$information->title.' of conference '.$conference->title.' is deleted');
        return redirect('conferences/'.$conference_id);
    }
}
