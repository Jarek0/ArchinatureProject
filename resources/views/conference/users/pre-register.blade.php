@extends('conference.information.index')
@section('articles')

    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Registration</div>
        <div class="panel-body">
            {!! Form::open(['url'=>'show/register','class'=>'form-horizontal']) !!}
            {{ csrf_field() }}
                <h3 class="col-md-6 col-md-offset-1">I am</h3>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-2">
                        {!! Form::radio('user_type', 'student') !!}

                    {!! Form::label('user_type','Student') !!}
                    </div>
                </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-2">
                    {!! Form::radio('user_type', 'phdstudent') !!}

                    {!! Form::label('user_type','PhD student') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-2">
                    {!! Form::radio('user_type', 'graduate') !!}

                    {!! Form::label('user_type','Graduate') !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-2">
                    {!! Form::radio('user_type', 'guardian') !!}

                    {!! Form::label('user_type','Mentors to student interest group') !!}
                </div>
            </div>
            @include('form_errors')
            <div class="form-group">
                <div class="col-md-6 col-md-offset-2">
                    {!! Form::submit('Next',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection