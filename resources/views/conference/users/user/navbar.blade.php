
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
                    <li class="dropdown"><a href = "{{ action('UserController@index')}}" class="dropbtn {{( Session::has('option_id') ? ( Session::get('option_id')==0 ? 'active' : ''): '')}}">Information</a></li>
                    <li class="dropdown"><a href = "{{ action('UserController@edit')}}" class="dropbtn {{( Session::has('option_id') ? ( Session::get('option_id')==1 ? 'active' : ''): '')}}">Your data</a></li>
                    <li class="dropdown"><a href = "{{ action('UserController@files') }}" class="dropbtn {{( Session::has('option_id') ? ( Session::get('option_id')==2 ? 'active' : ''): '')}}">Your theses</a></li>
                    <li class="dropdown"><a href = "{{ action('UserController@meetings') }}" class="dropbtn {{( Session::has('option_id') ? ( Session::get('option_id')==3 ? 'active' : ''): '')}}">Meetings</a></li>
                    <li class="dropdown"><a href = "{{ action('UserController@contact') }}" class="dropbtn {{( Session::has('option_id') ? ( Session::get('option_id')==4 ? 'active' : ''): '')}}">Contact</a></li>
                        @include('conference.users.user.dropdown')
                    @if(Session::has('conference_id'))
                        <li class="login_button"><a href={{url('conferences', Session::get('conference_id'))}}>MY ACCOUNT</a></li>
                    @endif
                </ul>
            </div>

        </div>
    </nav>
