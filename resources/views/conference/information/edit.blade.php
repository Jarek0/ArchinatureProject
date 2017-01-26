@extends('formFrame')
@section('form')
    {!! Form::model($information,['method'=>'PATCH','class'=>'form-horizontal','action'=>['InformationController@update',$conference_id,$information->id]]) !!}

    @include('form_errors')
    @include('form',['buttonText'=>'Update information'])

    {!! Form::close() !!}
@stop