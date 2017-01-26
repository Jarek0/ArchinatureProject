@extends('conference.users.index')
@section('articles')

    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">{{$meeting->date}} participants</div>

        <div class="panel-body">
            @foreach($meeting->users as $user)
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>E-mail</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->surname}}</td>
                            <td>{{$user->email}}</td>
                            <td>

                                <div class="btn-group">


                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Options <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>

                                            <a  href="{{action('AdminController@showUser',$user->id)}}">Details</a>

                                        </li>
                                        <li>
                                            <a  href="{{action('AdminController@deleteUserFromMeeting',[$meeting->id,$user->id])}}">Delete</a>
                                        </li>
                                    </ul>

                                </div>

                            </td>

                        </tr>

                    </tbody>
                </table>
            @endforeach

        </div>
    </div>

@endsection