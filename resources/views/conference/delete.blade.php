@extends('formFrame')
@section('form')


       {{ Form::open(['method' => 'DELETE','class'=>'form-horizontal', 'action'=>['ConferencesController@destroy', $conference_id]]) }}

        <div class="modal-body">
                {!! Form::label('title','Are you sure?') !!}

        </div>


        <div class="modal-footer">
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
            <button type="button" class="btn btn-primary" onclick="window.location='{{ url("conferences/".$conference_id) }}'">Cancel</button>
        </div>

    {{ Form::close() }}

    {!! Form::close() !!}

@stop