<?php

namespace Aska\Http\Controllers;

use Aska\Http\Requests\CreateBannerRequest;
use Aska\Conference;
use Aska\Banner;
use Session;

class BannersController extends Controller
{
    public function edit($conference_id,$banner_id){
        $conference=Conference::findOrFail($conference_id);
        $banner=$conference->banner;
        if($banner===null){
            $banner=Banner::create(['conference_id'=>$conference->id,'path'=>'images/banners/default_banner.jpg']);
        }
        $panelText="Edit banner";
        return view('conference.banner.edit',compact('panelText','conference_id','banner_id'));
    }
    public function update(CreateBannerRequest $request,$conference_id,$banner_id){
        $conference=Conference::findOrFail($conference_id);
        $banner=$conference->banner;
        if($banner===null){
            $banner=Banner::create(['conference_id'=>$conference->id,'path'=>'images/banners/default_banner.jpg']);
            return redirect('conferences/'.$conference_id);
        }
        $imageName = $conference->id . '.' .$request->file('image')->getClientOriginalExtension();
        $banner->update(['path'=>'images/banners/'.$imageName]);
        $request->file('image')->move(base_path() . '/public/images/banners', $imageName);
        Session::flash('success','Banner of ' .$conference->title. ' is changed');
        return redirect('conferences/'.$conference_id);
    }
}
