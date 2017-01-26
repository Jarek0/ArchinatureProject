@extends('conference.index')
@section('informations')
    @if (Auth::guard("admin")->user())
        @include('conference.users.admin.navbar')
    @elseif(!Auth::guest())
        @include('conference.users.user.navbar')
    @endif

@stop