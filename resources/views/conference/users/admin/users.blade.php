@extends('conference.users.index')
@section('articles')

    @include('form_errors')
        @if(count($students) >0)
        <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Students</div>

        <div class="panel-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->surname}}</td>
                    <td>{{$student->email}}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success" onclick="window.location='{{ action('AdminController@showUser', $student->id) }}'">Details</button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu">
                                @if(!$student->verified)
                                <li>

                                    <a  onclick="document.forms['verifyForm{{$student->id}}'].submit();">Verify</a>

                                </li>
                                @endif
                                <li>

                                    @if(!$student->banned)
                                        <a  onclick="document.forms['banForm{{$student->id}}'].submit()">Ban</a>

                                    @else
                                        <a  onclick="document.forms['banForm{{$student->id}}'].submit()">Unlock</a>
                                    @endif

                                </li>
                                    <li>
                                            <a  href="{{ action('AdminController@delete', $student->id) }}">Delete</a>
                                    </li>
                            </ul>
                        </div>
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"verifyForm$student->id",'action'=>['AdminController@verify',$student->id]]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"banForm$student->id",'action'=>['AdminController@ban',$student->id]]) !!}
                                    {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        </div>
        @endif

            @if(count($phdstudents) >0)
                <div class="panel custom-panel dropbtn">
                <div class="panel-heading">PhD Students</div>

                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($phdstudents as $phdstudent)
                            <tr>
                                <td>{{$phdstudent->name}}</td>
                                <td>{{$phdstudent->surname}}</td>
                                <td>{{$phdstudent->email}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success" onclick="window.location='{{ action('AdminController@showUser', $phdstudent->id) }}'">Details</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if(!$phdstudent->verified)
                                                <li>

                                                    <a  onclick="document.forms['verifyForm{{$phdstudent->id}}'].submit();">Verify</a>

                                                </li>
                                            @endif
                                            <li>

                                                @if(!$phdstudent->banned)
                                                    <a  onclick="document.forms['banForm{{$phdstudent->id}}'].submit()">Ban</a>

                                                @else
                                                    <a  onclick="document.forms['banForm{{$phdstudent->id}}'].submit()">Unlock</a>
                                                @endif

                                            </li>
                                                <li>
                                                    <a  href="{{ action('AdminController@delete', $phdstudent->id) }}">Delete</a>
                                                </li>
                                        </ul>
                                    </div>
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"verifyForm$phdstudent->id",'action'=>['AdminController@verify',$phdstudent->id]]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"banForm$phdstudent->id",'action'=>['AdminController@ban',$phdstudent->id]]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                </div>
            @endif

            @if(count($graduates) >0)
                <div class="panel custom-panel dropbtn">
                <div class="panel-heading">Graduates</div>

                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($graduates as $graduated)
                            <tr>
                                <td>{{$graduated->name}}</td>
                                <td>{{$graduated->surname}}</td>
                                <td>{{$graduated->email}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success" onclick="window.location='{{ action('AdminController@showUser', $graduated->id) }}'">Details</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if(!$graduated->verified)
                                                <li>

                                                    <a  onclick="document.forms['verifyForm'{{$graduated->id}}].submit();">Verify</a>

                                                </li>
                                            @endif
                                            <li>

                                                @if(!$graduated->banned)
                                                    <a  onclick="document.forms['banForm{{$graduated->id}}'].submit()">Ban</a>

                                                @else
                                                    <a  onclick="document.forms['banForm{{$graduated->id}}'].submit()">Unlock</a>
                                                @endif

                                            </li>
                                                <li>
                                                    <a  href="{{ action('AdminController@delete', $graduated->id) }}">Delete</a>
                                                </li>
                                        </ul>
                                    </div>
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"verifyForm$graduated->id",'action'=>['AdminController@verify',$graduated->id]]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"banForm$graduated->id",'action'=>['AdminController@ban',$graduated->id]]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                </div>
            @endif

            @if(count($guardians) >0)
                <div class="panel custom-panel dropbtn">
                <div class="panel-heading">Mentors to student interest group</div>

                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($guardians as $guardian)
                            <tr>
                                <td>{{$guardian->name}}</td>
                                <td>{{$guardian->surname}}</td>
                                <td>{{$guardian->email}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success" onclick="window.location='{{ action('AdminController@showUser', $guardian->id) }}'">Details</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if(!$guardian->verified)
                                                <li>

                                                    <a onclick="document.forms['verifyForm{{$guardian->id}}'].submit();">Verify</a>

                                                </li>
                                            @endif
                                            <li>

                                                @if(!$graduated->banned)
                                                    <a  onclick="document.forms['banForm{{$guardian->id}}'].submit()">Ban</a>
                                                @else
                                                    <a  onclick="document.forms['banForm{{$guardian->id}}'].submit()">Unlock</a>
                                                @endif

                                            </li>
                                                <li>
                                                    <a  href="{{ action('AdminController@delete', $guardian->id) }}">Delete</a>
                                                </li>
                                        </ul>
                                    </div>
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"verifyForm$guardian->id",'action'=>['AdminController@verify',$guardian->id]]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::model(null,['method'=>'POST','class'=>'form-horizontal','name'=>"banForm$guardian->id",'action'=>['AdminController@ban',$guardian->id]]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                </div>

            @endif

@endsection