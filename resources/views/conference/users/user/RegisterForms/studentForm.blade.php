<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">School:</label>

    @include('conference.users.user.Registration elements.schoolField')

    @include('conference.users.user.Registration elements.schoolFieldOfStudyField')
<div class="form-group{{ $errors->has('school_degree') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Degree:</label>

    <div class="col-md-6">
        <div class="radio">
            <label>{!! Form::radio('school_degree', 'engineering') !!}engineering</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('school_degree', 'masters') !!}masters</label>
        </div>
        @if ($errors->has('school_degree'))
            <span class="help-block">
                                        <strong>{{ $errors->first('school_degree') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div class="form-group{{ $errors->has('science_club') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Are you a member of science club?:</label>

    <div class="col-md-6">
        <div class="radio">
            <label>{!! Form::radio('science_club', '1', true,['id'=>'science_club','onchange' => 'displayScienceClubForm(this)']) !!}Yes</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('science_club', '0', true,['onchange' => 'displayScienceClubForm(this)']) !!}No</label>
        </div>
        @if ($errors->has('science_club'))
            <span class="help-block">
                                        <strong>{{ $errors->first('science_club') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div id="scienceClubForm" style="display: none;">
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
            {!! Form::email('science_club_email',old('science_club_email'),['class'=>'form-control']) !!}
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
    <div class="form-group{{ $errors->has('science_club_function') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Your function:</label>

        <div class="col-md-6" >
            <div class="styled-select">
                {!!
                Form::select('science_club_function', array(
                'member' => 'Member',
                'board_member' => 'Board member',
                'chairman' => 'Chairman'
                ))
                !!}
            </div>
            @if ($errors->has('science_club_function'))
                <span class="help-block">
                                        <strong>{{ $errors->first('science_club_function') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('science_club_guardian') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Science club guardian:</label>

        <div class="col-md-6">
            {!! Form::text('science_club_guardian',old('science_club_guardian'),['class'=>'form-control']) !!}
            @if ($errors->has('science_club_guardian'))
                <span class="help-block">
                                        <strong>{{ $errors->first('science_club_guardian') }}</strong>
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
</div>
<script>
    (function() {
        if(document.getElementById("science_club").checked==true){
            document.getElementById("scienceClubForm").style.display = "block";
        }
    })();
    function displayScienceClubForm(that) {

        if (that.value == '1') {
            document.getElementById("scienceClubForm").style.display = "block";
        } else {
            document.getElementById("scienceClubForm").style.display = "none";
        }
    }
</script>