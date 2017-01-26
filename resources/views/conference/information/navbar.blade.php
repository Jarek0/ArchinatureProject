
<nav class = "navbar navbar-custom2" role = "navigation">
    <div class="container-fluid" >
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        </div>
        <div class="collapse navbar-collapse" id="menu">
        <ul class = "nav navbar-nav" >
            @if(Session::has('conference_id'))
            @if(!empty($informations))
            @foreach($informations as $information)
            <li class="dropdown">
                <a href = "{{ action('InformationController@show', ['conference_id'=>$information->conference->id,'information_id'=>$information->id]) }}" class="dropbtn {{( Session::has('information_id') ? ( Session::get('information_id')==$information->id ? 'active' : ''): '')}}">{{$information->title}}</a>
                @if (Auth::guard("admin")->user())
                <div class="dropdown-content-down">
                    <a title="edit information" href="{{ action('InformationController@edit', ['conference_id'=>$information->conference->id,'information_id'=>$information->id]) }}"><span class="glyphicon glyphicon-wrench pull-right" /></span><span class="dropdown-link-text "/></a>
                    <a title="delete information" href="{{ action('InformationController@delete', ['conference_id'=>$information->conference->id,'information_id'=>$information->id]) }}"><span class="glyphicon glyphicon-trash pull-right"/></span><span class="dropdown-link-text "/></a>
                    <a title="add article" href="{{ action('ArticlesController@create', ['conference_id'=>$information->conference->id,'information_id'=>$information->id]) }}"><span class="glyphicon glyphicon-plus pull-right icon"/></span><span class="dropdown-link-text "/></a>
                </div>
                @endif
            </li>
            @endforeach
            @endif

            <li class="login_button"><a href={{url('login')}}>MY ACCOUNT</a></li>
            @endif
        </ul>
        </div>

    </div>
</nav>