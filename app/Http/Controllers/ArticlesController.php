<?php

namespace Aska\Http\Controllers;
use Aska\Article;
use Aska\Conference;
use Aska\Http\Requests\CreateArticleRequest;
use Request;
use Session;

class ArticlesController extends Controller
{
    public function show($conference_id,$information_id,$article_id){
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
        $informations=$conference->informations;
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
    public function index($conference_id,$information_id){
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
        $informations=$conference->informations;
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
    public function create($conference_id,$information_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $panelText="Create article";
        return view('conference.information.article.create',compact('panelText','conference_id','information_id'));
    }
    public function store($conference_id,$information_id,CreateArticleRequest $request){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $article=Article::create(['information_id'=>$information->id,'title'=>$request['title'],'content'=>$request['content']]);
        Session::flash('success','Article '.$article->title.' of ' .$information->title. '. of ' .$conference->title. ' is created');
        return redirect('conferences/'.$conference_id.'/informations/'.$information_id.'/articles/'.$article->id);
    }
    public function edit($conference_id,$information_id,$article_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $articles=$information->articles;
        $article=ExtrasFunctions::objectFinder($articles,$article_id);
        if($article===null){
            Session::flash('fail','Error: cannot find article with id='.$article_id.' of information '.$information->title.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id."/informations/".$information_id);
        }
        $panelText="Edit article";
        return view('conference.information.article.edit',compact('article','panelText','conference_id','information_id'));
    }
    public function update(CreateArticleRequest $request,$conference_id,$information_id,$article_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $articles=$information->articles;
        $article=ExtrasFunctions::objectFinder($articles,$article_id);
        if($article===null){
            Session::flash('fail','Error: cannot find article with id='.$article_id.' of information '.$information->title.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id."/informations/".$information_id);
        }
        $article->update($request->all());
        Session::flash('success','Article '.$article->title.' of information ' .$information->title. '. of conference ' .$conference->title. ' is edited');
        return redirect('conferences/'.$conference_id.'/informations/'.$information_id.'/articles/'.$article->id);
    }
    public function delete($conference_id,$information_id,$article_id){
        $conference=Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $articles=$information->articles;
        $article=ExtrasFunctions::objectFinder($articles,$article_id);
        if($article===null){
            Session::flash('fail','Error: cannot find article with id='.$article_id.' of information '.$information->title.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id."/informations/".$information_id);
        }
        $panelText="Delete article";
        return view('conference.information.article.delete',compact('article_id','panelText','information_id','conference_id'));
    }
    public function destroy($conference_id,$information_id,$article_id){
        $conference = Conference::findOrFail($conference_id);
        $informations=$conference->informations;
        $information=ExtrasFunctions::objectFinder($informations,$information_id);
        if($information===null){
            Session::flash('fail','Error: cannot find information with id='.$information_id.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id);
        }
        $articles=$information->articles;
        $article=ExtrasFunctions::objectFinder($articles,$article_id);
        if($article===null){
            Session::flash('fail','Error: cannot find article with id='.$article_id.' of information '.$information->title.' of conference '.$conference->title);
            return redirect('conferences/'.$conference_id."/informations/".$information_id);
        }
        $article->delete();
        Session::flash('success','Article '.$article->title.' of information ' .$information->title. '. of conference ' .$conference->title. ' is deleted');
        return redirect('conferences/'.$conference_id."/informations/".$information_id);
    }
}
