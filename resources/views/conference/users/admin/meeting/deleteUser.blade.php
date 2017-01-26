@extends('formFrame')
@section('form')


    {{ Form::open(['method' => 'DELETE','class'=>'form-horizontal', 'action'=>['AdminController@destroyUserFromMeeting', $meeting_id,$user_id]]) }}

    <div class="modal-body">
        {!! Form::label('title','Are you sure?') !!}

    </div>


    <div class="modal-footer">
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("admin_panel/meetings/$meeting_id") }}'">Cancel</button>
    </div>

    {{ Form::close() }}

    {!! Form::close() !!}

@stop