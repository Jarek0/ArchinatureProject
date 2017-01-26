<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">School:</label>

    @include('conference.users.user.Registration elements.schoolField')

<div class="form-group{{ $errors->has('school_institute') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Institude:</label>

    <div class="col-md-6">
        {!! Form::text('school_institute',old('school_institute'),['class'=>'form-control']) !!}
        @if ($errors->has('school_institute'))
            <span class="help-block">
                                        <strong>{{ $errors->first('school_institute') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('school_establishment') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Establishment:</label>

    <div class="col-md-6">
        {!! Form::text('school_establishment',old('school_establishment'),['class'=>'form-control']) !!}
        @if ($errors->has('school_establishment'))
            <span class="help-block">
                                        <strong>{{ $errors->first('school_establishment') }}</strong>
                        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('science_club_name') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Name of science club:</label>

    <div class="col-md-6">
        {!! Form::text('science_club_name',old('science_club_name'),['class'=>'form-control']) !!}
        @if ($errors->has('science_club_name'))
            <span class="help-block">
                                        <strong>{{ $errors->first('science_club_name') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('science_club_email') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">E-mail of science club:</label>

    <div class="col-md-6">
        {!! Form::text('science_club_email',old('science_club_email'),['class'=>'form-control']) !!}
        @if ($errors->has('science_club_email'))
            <span class="help-block">
                                        <strong>{{ $errors->first('science_club_email') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('science_club_page') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Page of science club:</label>

    <div class="col-md-6">
        {!! Form::text('science_club_page',old('science_club_page'),['class'=>'form-control']) !!}
        @if ($errors->has('science_club_page'))
            <span class="help-block">
                                        <strong>{{ $errors->first('science_club_page') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('science_club_information') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Information about science club:</label>

    <div class="col-md-6">
        {!! Form::text('science_club_information',old('science_club_information'),['class'=>'form-control']) !!}
        @if ($errors->has('science_club_information'))
            <span class="help-block">
                                        <strong>{{ $errors->first('science_club_information') }}</strong>
                        </span>
        @endif
    </div>
</div>