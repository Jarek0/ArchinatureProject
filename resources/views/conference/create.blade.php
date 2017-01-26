@extends('formFrame')
@section('form')
{!! Form::open(['url'=>'conferences','class'=>'form-horizontal']) !!}

@include('form_errors')
@include('form',['buttonText'=>'Add conference'])

{!! Form::close() !!}
@stop