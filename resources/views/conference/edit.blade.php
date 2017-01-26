@extends('formFrame')
@section('form')
    {!! Form::model($conference,['method'=>'PATCH','class'=>'form-horizontal','action'=>['ConferencesController@update',$conference->id]]) !!}

    @include('form_errors')
    @include('form',['buttonText'=>'Update conference'])

    {!! Form::close() !!}
@stop