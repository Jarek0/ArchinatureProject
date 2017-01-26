@extends('formFrame')
@section('form')
{!! Form::open(['url'=>'admin_panel/meetings','class'=>'form-horizontal']) !!}

@include('form_errors')
@include('conference.users.admin.meeting.form',['buttonText'=>'Add meeting'])

{!! Form::close() !!}
@stop