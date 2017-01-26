<?php

namespace Aska\Http\Controllers;

use Aska\Http\Requests\CreateSponsorsCategoryRequest;
use Aska\SponsorCategory;
use Aska\Sponsor;
use Aska\Conference;
use Session;

class SponsorsCategoriesController extends Controller
{
    public function create($conference_id){
        $conference=Conference::findOrFail($conference_id);
        $panelText="Create sponsors category";
        return view('conference.sponsors_category.create',compact('panelText','conference_id'));
    }
    public function store($conference_id,CreateSponsorsCategoryRequest $request){
        $conference=Conference::findOrFail($conference_id);
        $sponsors_category=SponsorCategory::create(['conference_id'=>$conference->id,'name'=>$request['name']]);
        $sponsor=Sponsor::create(['sponsor_category_id'=>$sponsors_category->id,'website_link'=>'http://www.pollub.pl','image_path'=>'images/logos/default_logo.png']);
        Session::flash('success','Sponsor category '.$sponsors_category->name.' of ' .$conference->title. ' is created');
        return redirect('conferences/'.$conference_id);
    }
    public function edit($conference_id,$sponsor_category_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsors_categories=$conference->sponsorsCategories;
        $sponsors_category=ExtrasFunctions::objectFinder($sponsors_categories,$sponsor_category_id);
        if($sponsors_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Edit sponsors category";
        return view('conference.sponsors_category.edit',compact('sponsors_category','panelText','conference_id'));
    }
    public function update(CreateSponsorsCategoryRequest $request,$conference_id,$sponsor_category_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsors_categories=$conference->sponsorsCategories;
        $sponsors_category=ExtrasFunctions::objectFinder($sponsors_categories,$sponsor_category_id);
        if($sponsors_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $sponsors_category->update($request->all());
        Session::flash('success','Sponsor category '.$sponsors_category->name.' of ' .$conference->title. ' is edited');
        return redirect('conferences/'.$conference_id);
    }
    public function delete($conference_id,$sponsor_category_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsors_categories=$conference->sponsorsCategories;
        $sponsors_category=ExtrasFunctions::objectFinder($sponsors_categories,$sponsor_category_id);
        if($sponsors_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Delete sponsors category";
        return view('conference.sponsors_category.delete',compact('sponsor_category_id','panelText','conference_id'));
    }
    public function destroy($conference_id,$sponsor_category_id){
        $conference = Conference::findOrFail($conference_id);
        $sponsors_categories=$conference->sponsorsCategories;
        /*if(count($informations)<=1){
            //Session::flash('fail','Information '.$information->title.' is only one information of conference '.$conference->title.' and it can not be deleted');
            return redirect('conferences/'.$conference_id.'/informations/'.$information_id);
        }*/
        $sponsors_category=ExtrasFunctions::objectFinder($sponsors_categories,$sponsor_category_id);
        if($sponsors_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $sponsors_category->delete();
        Session::flash('success','Sponsors category '.$sponsors_category->name.' of conference '.$conference->title.' is deleted');
        return redirect('conferences/'.$conference_id);
    }
}
