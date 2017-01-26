@extends('conference.information.article.formFrame')
@section('form')
    {!! Form::model($article,['method'=>'PATCH','class'=>'form-horizontal','action'=>['ArticlesController@update',$conference_id,$information_id,$article->id]]) !!}

    @include('form_errors')

    @include('conference.information.article.form',['buttonText'=>'Update article'])


    {!! Form::close() !!}
@stop