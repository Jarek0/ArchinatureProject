@extends('conference.users.index')
@section('articles')

    @include('form_errors')
    @if(count($users) >0)
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Users files</div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>E-mail</th>
                        <th>Presentation</th>
                        <th>Summary</th>
                        <th>Poliforum</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->email}}</td>
                            <td>

                                @if(!empty($user->presentation))
                                <div class="btn-group">


                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Options <span class="caret"></span>
                                    </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a  href="{{action('AdminController@downloadPresentation',$user->id)}}">Download</a>

                                            </li>
                                            <li>
                                                <a  href="{{action('AdminController@deletePresentation',$user->id)}}">Delete</a>
                                            </li>
                                        </ul>

                                </div>
                                @endif

                            </td>
                            <td>

                                @if(!empty($user->summary))
                                    <div class="btn-group">


                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a  href="{{action('AdminController@downloadSummary',$user->id)}}">Download</a>

                                            </li>
                                            <li>
                                                <a  href="{{action('AdminController@deleteSummary',$user->id)}}">Delete</a>
                                            </li>
                                        </ul>

                                    </div>
                                @endif

                            </td>
                            <td>

                                @if(!empty($user->poliforum))
                                    <div class="btn-group">


                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a  href="{{action('AdminController@downloadPoliforum',$user->id)}}">Download</a>

                                            </li>
                                            <li>
                                                <a  href="{{action('AdminController@deletePoliforum',$user->id)}}">Delete</a>
                                            </li>
                                        </ul>

                                    </div>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        @else
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Users files</div>

            <div class="panel-body">
                There are not any fiels of users
        </div>
        </div>
    @endif



@endsection