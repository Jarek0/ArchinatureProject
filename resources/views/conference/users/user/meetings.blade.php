@extends('conference.users.index')
@section('articles')

    @include('form_errors')

    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Meetings</div>

        <div class="panel-body">
            {!! Form::model($meetings,['method'=>'POST','class'=>'form-horizontal','action'=>['UserController@acceptMeetings']]) !!}
            @if(count($meetings) >0)


                    @foreach($meetings as $meeting)
                        <div class="row">
                    <div class="col-md-5 breadcrumb" style="color:black;">
                        @if($meeting->hasUser( Auth::user()->id))
                            {!! Form::checkbox($meeting->id,$meeting->id,true)!!}

                            @else
                            {!! Form::checkbox($meeting->id,$meeting->id,false)!!}
                        @endif

                           {{$meeting->date}}

                    </div>
                        </div>
                    @endforeach


            @endif
            <div class="row">
                <div class="col-md-5">
            <button type="submit" class="btn btn-success">Accept</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection