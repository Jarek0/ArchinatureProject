@extends('formFrame')
@section('form')
    {!! Form::model($sponsors_category,['method'=>'PATCH','class'=>'form-horizontal','action'=>['SponsorsCategoriesController@update',$conference_id,$sponsors_category->id]]) !!}

    @include('form_errors')
    @include('conference.sponsors_category.form',['buttonText'=>'Update sponsors category'])

    {!! Form::close() !!}
@stop