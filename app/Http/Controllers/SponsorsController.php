<?php

namespace Aska\Http\Controllers;
use Aska\Conference;
use Aska\Http\Requests\CreateSponsorRequest;
use Aska\Sponsor;
use File;
use Session;

class SponsorsController extends Controller
{

    public function create($conference_id,$sponsor_category_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsor_categories=$conference->sponsorsCategories;
        $sponsor_category=ExtrasFunctions::objectFinder($sponsor_categories,$sponsor_category_id);
        if($sponsor_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Create sponsor";
        return view('conference.sponsors_category.sponsor.create',compact('panelText','conference_id','sponsor_category_id'));
    }

    public function store($conference_id,$sponsor_category_id,CreateSponsorRequest $request){
        $conference=Conference::findOrFail($conference_id);
        $sponsor_categories=$conference->sponsorsCategories;
        $sponsor_category=ExtrasFunctions::objectFinder($sponsor_categories,$sponsor_category_id);
        if($sponsor_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }

        $sponsor=Sponsor::create(['sponsor_category_id'=>$sponsor_category->id,'website_link'=>$request['website_link'],'image_path'=>'images/logos/default_logo.png']);
        $imageName = $sponsor->id . '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path() . '/public/images/logos', $imageName);
        $sponsor->update(['image_path'=>'images/logos/'.$imageName]);
        Session::flash('success','Sponsor '.$sponsor->id.' of ' .$sponsor_category->name. '. of ' .$conference->title. ' is created');
        return redirect('conferences/'.$conference_id);
    }



    public function edit($conference_id,$sponsor_category_id,$sponsor_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsor_categories=$conference->sponsorsCategories;
        $sponsor_category=ExtrasFunctions::objectFinder($sponsor_categories,$sponsor_category_id);
        if($sponsor_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $sponsors=$sponsor_category->sponsors;
        $sponsor=ExtrasFunctions::objectFinder($sponsors,$sponsor_id);
        if($sponsor===null){
            Session::flash('fail','Error: cannot find sponsor with id='.$sponsor_id.' of sponsor category '.$sponsor_category->name.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Edit sponsor";
        return view('conference.sponsors_category.sponsor.edit',compact('sponsor','panelText','conference_id','sponsor_category_id'));
    }
    public function update(CreateSponsorRequest $request,$conference_id,$sponsor_category_id,$sponsor_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsor_categories=$conference->sponsorsCategories;
        $sponsor_category=ExtrasFunctions::objectFinder($sponsor_categories,$sponsor_category_id);
        if($sponsor_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id,' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $sponsors=$sponsor_category->sponsors;
        $sponsor=ExtrasFunctions::objectFinder($sponsors,$sponsor_id);
        if($sponsor===null){
            Session::flash('fail','Error: cannot find sponsor with id='.$sponsor_id.' of sponsor category '.$sponsor_category->name.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $imageName = $sponsor->id . '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(base_path() . '/public/images/logos', $imageName);
        $sponsor->update(['sponsor_category_id'=>$sponsor_category->id,'website_link'=>$request['website_link'],'image_path'=>'images/logos/'.$imageName]);
        Session::flash('success','Sponsor '.$sponsor->id.' of category ' .$sponsor_category->name. '. of conference ' .$conference->title. ' is created');
        return redirect('conferences/'.$conference_id);
    }

    public function delete($conference_id,$sponsor_category_id,$sponsor_id){
        $conference=Conference::findOrFail($conference_id);
        $sponsor_categories=$conference->sponsorsCategories;
        $sponsor_category=ExtrasFunctions::objectFinder($sponsor_categories,$sponsor_category_id);
        if($sponsor_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $sponsors=$sponsor_category->sponsors;
        $sponsor=ExtrasFunctions::objectFinder($sponsors,$sponsor_id);
        if($sponsor===null){
            Session::flash('fail','Error: cannot find sponsor with id='.$sponsor_id.' of sponsor category '.$sponsor_category->name.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Delete sponsor";
        return view('conference.sponsors_category.sponsor.delete',compact('sponsor_id','panelText','sponsor_category_id','conference_id'));
    }

    public function destroy($conference_id,$sponsor_category_id,$sponsor_id){
        $conference = Conference::findOrFail($conference_id);
        $sponsor_categories=$conference->sponsorsCategories;
        $sponsor_category=ExtrasFunctions::objectFinder($sponsor_categories,$sponsor_category_id);
        if($sponsor_category===null){
            Session::flash('fail','Error: cannot find sponsor category with id='.$sponsor_category_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $sponsors=$sponsor_category->sponsors;
        $sponsor=ExtrasFunctions::objectFinder($sponsors,$sponsor_id);
        if($sponsor===null){
            Session::flash('fail','Error: cannot find sponsor with id='.$sponsor_id.' of sponsor category '.$sponsor_category->name.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        if($sponsor->image_path!='images/logos/default_logo.png')
        File::Delete(base_path() . '/public/'.$sponsor->image_path);
        $sponsor->delete();
        Session::flash('success','Sponsor '.$sponsor->id.' of category ' .$sponsor_category->name. '. of conference ' .$conference->title. ' is deleted');
        return redirect('conferences/'.$conference_id);
    }
}
