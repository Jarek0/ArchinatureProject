
<nav class="navbar navbar-inverse navbar-fixed-top navbar-custom" role="navigation">
    <div class="container-fluid">

        <div class="navbar-header">

            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/archinature_logo.png') }}" alt="Archinature"/>
            </a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ConferencesNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <div class="collapse navbar-collapse" id="ConferencesNavbar">
            <ul class="nav navbar-nav">
                @if(!empty($conferences))
                @foreach($conferences as $conference)
                    <li class="dropdown">

                        <a href="{{ action('ConferencesController@show', $conference->id) }}" class="dropbtn  {{( Session::has('conference_id') ? ( Session::get('conference_id')==$conference->id ? 'active' : ''): '')}}">{{$conference->title}}</a>
                        @if (Auth::guard("admin")->user())
                        <div class="dropdown-content-down">
                            <a title="edit conference" href="{{ action('ConferencesController@edit', $conference->id) }}"><span class="glyphicon glyphicon-wrench pull-right icon" /></span><span class="dropdown-link-text "/></a>
                            <a title="delete conference" href="{{ action('ConferencesController@delete', $conference->id) }}"><span class="glyphicon glyphicon-trash pull-right icon"/></span><span class="dropdown-link-text "/></a>
                            <a title="create information" href="{{ action('InformationController@create', $conference->id) }}"><span class="glyphicon glyphicon-plus pull-right icon"/></span><span class="dropdown-link-text "/></a>
                            <a title="create sponsor category" href="{{ action('SponsorsCategoriesController@create', $conference->id) }}"><span class="glyphicon glyphicon-plus pull-right icon"/></span><span class="dropdown-link-text "/></a>
                            <a title="edit banner" href="{{ action('BannersController@edit', ['conference_id'=>$conference->id,'banner_id'=>$conference->banner->id]) }}"><span class="glyphicon glyphicon-pencil pull-right icon"/></span><span class="dropdown-link-text "/></a>
                        </div>

                        @endif
                    </li>
                @endforeach
                @endif
                @if (Auth::guard("admin")->user())
                <li>
                <li><a href="{{ url('conferences/create')}}"><span class="glyphicon glyphicon-plus"/></a></li>
                </li>
                @endif
            </ul>

        </div>
    </div>
    </div>

</nav>
