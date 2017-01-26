@extends('conference.information.index')
@section('articles')
    @if(Session::has('conference_id'))
        @if(Session::has('information_id'))
            @if(!empty($informations))
                @foreach($informations as $information)
                    @if(Session::get('information_id')==$information->id)

                    @foreach($information->articles as $article)
                    <div class="dropdown">
                    <div class="panel custom-panel dropbtn">
                    <div class="panel-heading">
                        {{$article->title}}
                    </div>
                    <div class="panel-body">
                    <p><?php echo $article->content ?></p>
                    </div>
                    </div>
                    <div class="dropdown-content">
                    @if (Auth::guard("admin")->user())
                        <a title="edit article"  href="{{ action('ArticlesController@edit', ['conference_id'=>$article->information->conference->id,'information_id'=>$article->information->id,'article_id'=>$article->id]) }}" >Edit&nbsp<span class="glyphicon glyphicon-wrench pull-right" /></a>
                        <a title="delete article"  href="{{ action('ArticlesController@delete', ['conference_id'=>$article->information->conference->id,'information_id'=>$article->information->id,'article_id'=>$article->id]) }}" >Delete&nbsp<span class="glyphicon glyphicon-trash pull-right"/></a>
                    @endif
                    </div>
                    </div>
                    @endforeach

                    @break
                    @endif
                @endforeach
            @endif
        @endif
    @endif
@stop