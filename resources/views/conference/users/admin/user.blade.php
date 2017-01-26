@extends('conference.users.index')
@section('articles')

    @include('form_errors')
    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Personal data</div>
        <div class="panel-body">
            <div class="row">
                <label class="col-md-4">Type of user:</label>

                <div class="col-md-6">
                    @if($user->user_type=="student")
                        <div class="col-md-6">Student</div>
                    @elseif($user->user_type=="phdstudent")
                        <div class="col-md-6">PhD student</div>
                    @elseif($user->user_type=="graduate")
                        <div class="col-md-6">Graduate</div>
                    @elseif($user->user_type=="guardian")
                        <div class="col-md-6"> Mentor to student interest group</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">E-Mail Address:</label>

                <div class="col-md-6">
                    {{$user->email}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Name:</label>

                <div class="col-md-6">
                    {{$user->name}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Surname:</label>

                <div class="col-md-6">
                    {{$user->surname}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Phone:</label>

                <div class="col-md-6">
                    {{$user->phone}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Theme of refer:</label>

                <div class="col-md-6">
                    {{$user->refer_theme}}
                </div>
            </div>
        </div>
    </div>
    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Information about account</div>
        <div class="panel-body">
            <div class="row">
                <label class="col-md-4">Created at:</label>

                <div class="col-md-6">
                    {{$user->created_at}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Last update:</label>

                <div class="col-md-6">
                    {{$user->updated_at}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Last logged:</label>

                <div class="col-md-6">
                    {{$user->last_logged}}
                </div>
            </div>
            <div class="row">
                <label class="col-md-4">Locked:</label>
                @if($user->banned)
                <div class="col-md-6">
                    {{ Form::checkbox('banned',1,true,array('disabled')) }}
                </div>
                @else
                <div class="col-md-6">
                    {{ Form::checkbox('banned',1,false,array('disabled')) }}
                </div>
                @endif
            </div>
            <div class="row">
                <label class="col-md-4">Verified:</label>
                @if($user->verified)
                    <div class="col-md-6">
                        {{ Form::checkbox('banned',1,true,array('disabled')) }}
                    </div>
                @else
                    <div class="col-md-6">
                        {{ Form::checkbox('banned',1,false,array('disabled')) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if($user->school!==null)
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">University</div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Name:</label>

                    <div class="col-md-6">
                        {{$user->school}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Field of study:</label>

                    <div class="col-md-6">
                        {{$user->school_field_of_study}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Institute:</label>

                    <div class="col-md-6">
                        {{$user->school_institute}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Establishment:</label>

                    <div class="col-md-6">
                        {{$user->school_establishment}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Degree of study:</label>

                    <div class="col-md-6">
                        {{$user->school_degree}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Employee universities:</label>
                    @if($user->employee_universities)
                        <div class="col-md-6">
                            {{ Form::checkbox('banned',1,true,array('disabled')) }}
                        </div>
                    @else
                        <div class="col-md-6">
                            {{ Form::checkbox('banned',1,false,array('disabled')) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    @if($user->science_club)
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Science club</div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Name:</label>

                    <div class="col-md-6">
                        {{$user->science_club_name}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">E-mail adress:</label>

                    <div class="col-md-6">
                        {{$user->science_club_email}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Website:</label>

                    <div class="col-md-6">
                        {{$user->science_club_page}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Function in club:</label>

                    <div class="col-md-6">
                        {{$user->science_club_function}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Mentor:</label>

                    <div class="col-md-6">
                        {{$user->science_club_guardian}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Additional information:</label>

                    <div class="col-md-6">
                        {{$user->science_club_information}}
                    </div>
                </div>
            </div>
        </div>
    @endif
            @if($user->accompanying_person)
    <div class="panel custom-panel dropbtn">
         <div class="panel-heading">Accompanying person</div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Name:</label>

                    <div class="col-md-6">
                        {{$user->accompanying_person_name}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Surname:</label>

                    <div class="col-md-6">
                        {{$user->accompanying_person_surname}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">E-mail adress:</label>

                    <div class="col-md-6">
                        {{$user->accompanying_person_email}}
                    </div>
                </div>

        </div>
    </div>
            @endif

    @if($user->company)
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Company</div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Profile:</label>

                    <div class="col-md-6">
                        {{$user->company_profile}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Name:</label>

                    <div class="col-md-6">
                        {{$user->company_name}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Address:</label>

                    <div class="col-md-6">
                        {{$user->company_address}}
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">NIP:</label>

                    <div class="col-md-6">
                        {{$user->company_nip}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($user->facture)
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Invoice</div>
            <div class="panel-body">
                <div class="row">
                    <label class="col-md-4">Information:</label>

                    <div class="col-md-6">
                        {{$user->facture_information}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Files</div>

        <div class="panel-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Kind</th>
                    <th>Last version</th>
                    <th>Data</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>presentation</td>
                    <td>
                        @if(!empty($presentation->name))
                            {{ \Illuminate\Support\Str::limit($presentation->name, 25) }}
                        @else
                            empty
                        @endif
                    </td>
                    <td>
                        @if(!empty($presentation->updated_at))
                            {{$presentation->updated_at->format('Y-m-d')}}
                        @else
                            empty
                        @endif

                    </td>
                    <td>
                        <div class="btn-group">
                            @if(!empty($presentation->path))
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
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>summary</td>
                    <td>
                        @if(!empty($summary->name))
                            {{ \Illuminate\Support\Str::limit($summary->name, 25) }}
                        @else
                            empty
                        @endif
                    </td>
                    <td>
                        @if(!empty($summary->updated_at))
                            {{$summary->updated_at->format('Y-m-d')}}
                        @else
                            empty
                        @endif

                    </td>
                    <td>
                        <div class="btn-group">
                            @if(!empty($summary->path))
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
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>poliforum</td>
                    <td>
                        @if(!empty($poliforum->name))
                            {{ \Illuminate\Support\Str::limit($poliforum->name, 25) }}
                        @else
                            empty
                        @endif
                    </td>
                    <td>
                        @if(!empty($poliforum->updated_at))
                            {{$poliforum->updated_at->format('Y-m-d')}}
                        @else
                            empty
                        @endif

                    </td>
                    <td>
                        <div class="btn-group">
                            @if(!empty($poliforum->path))
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
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Meetings</div>

        <div class="panel-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->meetings as $meeting)
                <tr>
                    <td>{{$meeting->date}}</td>
                    <td>

                        <div class="btn-group">


                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>

                                    <a  href="{{action('AdminController@showMeeting',$meeting->id)}}">Details</a>

                                </li>
                                <li>
                                    <a  href="{{action('AdminController@deleteUserFromMeeting',[$meeting->id,$user->id])}}">Delete</a>
                                </li>
                            </ul>

                        </div>

                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection