@extends('formFrame')
@section('form')
    {!! Form::model($sponsor_category_id,['method'=>'POST','files' => true,'class'=>'form-horizontal','action'=>['SponsorsController@store',$conference_id,$sponsor_category_id]]) !!}

    @include('form_errors')

    @include('conference.sponsors_category.sponsor.form',['buttonText'=>'Add sponsor'])

    {!! Form::close() !!}
@stop