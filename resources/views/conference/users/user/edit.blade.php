@extends('conference.users.index')
@section('articles')
    <div class="panel custom-panel dropbtn">
        <div class="panel-heading">Your data</div>
        <div class="panel-body">
            {!! Form::model($user,['method'=>'PATCH','class'=>'form-horizontal','action'=>['UserController@update']]) !!}


            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Name:</label>

                <div class="col-md-6">
                    {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Surname:</label>

                <div class="col-md-6">
                    {!! Form::text('surname',old('surname'),['class'=>'form-control']) !!}

                    @if ($errors->has('surname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Phone:</label>

                <div class="col-md-6">
                    {!! Form::text('phone',old('phone'),['class'=>'form-control']) !!}

                    @if ($errors->has('phone'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            @if($user->user_type=="student")
                @include('conference.users.user.RegisterForms.studentForm')
            @elseif($user->user_type=="phdstudent")
                @include('conference.users.user.RegisterForms.phdstudentForm')
            @elseif($user->user_typee=="graduate")
                @include('conference.users.user.RegisterForms.graduateForm')
            @else
                @include('conference.users.user.RegisterForms.guardianForm')
            @endif

            <div class="form-group{{ $errors->has('accompanying_person') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Accompanying person:</label>

                <div class="col-md-6">
                    <div class="radio">
                        <label>{!! Form::radio('accompanying_person', '1', true,array('id'=>"accompanying_person",'onchange' => 'displayPartnerForm(this)')) !!}Yes</label>
                    </div>
                    <div class="radio">
                        <label>{!! Form::radio('accompanying_person', '0', true,array('onchange' => 'displayPartnerForm(this)')) !!}No</label>
                    </div>
                    @if ($errors->has('accompanying_person'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('accompanying_person') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div id="partnerForm" style="display: none;">
                <div class="form-group{{ $errors->has('accompanying_person_name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Name of partner:</label>

                    <div class="col-md-6">
                        {!! Form::text('accompanying_person_name',old('accompanying_person_name'),['class'=>'form-control']) !!}
                        @if ($errors->has('accompanying_person_name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('accompanying_person_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('accompanying_person_surname') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Surname of partner:</label>

                    <div class="col-md-6">
                        {!! Form::text('accompanying_person_surname',old('accompanying_person_surname'),['class'=>'form-control']) !!}
                        @if ($errors->has('accompanying_person_surname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('accompanying_person_surname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('accompanying_person_email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-mail of partner:</label>

                    <div class="col-md-6">
                        {!! Form::text('accompanying_person_email',old('accompanying_person_email'),['class'=>'form-control']) !!}
                        @if ($errors->has('accompanying_person_email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('accompanying_person_email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <script>
                (function() {
                    if(document.getElementById("accompanying_person").checked==true){
                        document.getElementById("partnerForm").style.display = "block";
                    }
                })();

                function displayPartnerForm(that) {
                    if (that.value == "1") {
                        document.getElementById("partnerForm").style.display = "block";
                    } else {
                        document.getElementById("partnerForm").style.display = "none";
                    }
                }
            </script>
            <div class="form-group{{ $errors->has('refer_theme') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Theme of refer:</label>

                <div class="col-md-6">
                    {!! Form::text('refer_theme',old('refer_theme'),['class'=>'form-control']) !!}
                    @if ($errors->has('refer_theme'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('refer_theme') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-user"></i>Edit
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection