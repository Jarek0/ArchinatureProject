@extends('conference.information.article.formFrame')
@section('form')
    {!! Form::model($information_id,['method'=>'POST','class'=>'form-horizontal','action'=>['ArticlesController@store',$conference_id,$information_id]]) !!}

    @include('form_errors')

    @include('conference.information.article.form',['buttonText'=>'Add article'])


    {!! Form::close() !!}
@stop