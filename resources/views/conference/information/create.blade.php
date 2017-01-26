@extends('formFrame')
@section('form')
    {!! Form::model($conference_id,['method'=>'POST','class'=>'form-horizontal','action'=>['InformationController@store',$conference_id]]) !!}

    @include('form_errors')

    @include('form',['buttonText'=>'Add information'])

    {!! Form::close() !!}
@stop