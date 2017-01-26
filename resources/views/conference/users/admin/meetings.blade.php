@extends('conference.users.index')
@section('articles')

    @include('form_errors')

        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Meetings</div>

            <div class="panel-body">
                @if(count($meetings) >0)
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Participants</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meetings as $meeting)
                        <tr>
                            <td>{{$meeting->date}}</td>
                            <td>{{$meeting->participants}}</td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-success" onclick="window.location='{{ action('AdminController@showMeeting', $meeting->id) }}'">Details</button>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                         <li>

                                                <a  href="{{ action('AdminController@editMeeting', $meeting->id) }}">Change</a>
                                         </li>
                                        <li>
                                                <a  href="{{ action('AdminController@deleteMeeting', $meeting->id) }}">Delete</a>
                                        </li>
                                    </ul>
                                </div>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
                <button type="button" class="btn btn-success" onclick="window.location='{{ action('AdminController@createMeeting') }}'">Add meeting</button>
            </div>
        </div>

@endsection