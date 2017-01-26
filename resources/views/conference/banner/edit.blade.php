@extends('formFrame')
@section('form')
    {!! Form::model($banner_id,['method'=>'PATCH','files' => true,'class'=>'form-horizontal','action'=>['BannersController@update',$conference_id,$banner_id]]) !!}

    @include('form_errors')
    @include('conference.banner.form',['buttonText'=>'Update banner'])

    {!! Form::close() !!}
@stop