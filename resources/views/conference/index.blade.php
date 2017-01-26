@extends('master')
@section('conferences')
    @include('conference.navbar')


    <div class="container">
        @include('conference.banner.index')
        @yield('informations')
        <div class="row-custom">
            @include('conference.left_panel')
            @include('conference.sponsors_category.right_panel')
        </div>

       {{-- <div class="row-custom">
            @include('conference.carousels')
        </div>--}}

</div>
@stop