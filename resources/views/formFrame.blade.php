@extends('master')
@section('conferences')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class = "panel panel-success">
                <div class = "panel-heading">
                    <h3 class = "panel-title">{{$panelText}}</h3>
                </div>

                <div class = "panel-body">
                    <!-- Formularz -->
                    @yield('form')

                </div>
            </div>
            </div>
        </div>
    </div>
@stop