@extends('formFrame')
@section('form')
    {!! Form::model($conference_id,['method'=>'POST','class'=>'form-horizontal','action'=>['SponsorsCategoriesController@store',$conference_id]]) !!}

    @include('form_errors')

    @include('conference.sponsors_category.form',['buttonText'=>'Add sponsors category'])

    {!! Form::close() !!}
@stop