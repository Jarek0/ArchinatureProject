@extends('formFrame')
@section('form')
    {!! Form::model($meeting,['method'=>'PATCH','class'=>'form-horizontal','action'=>['AdminController@updateMeeting',$meeting->id]]) !!}

    @include('form_errors')
    @include('conference.users.admin.meeting.form',['buttonText'=>'Add meeting'])

    {!! Form::close() !!}
@stop