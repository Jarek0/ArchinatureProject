<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">I finish school:</label>

    @include('conference.users.user.Registration elements.schoolField')

    @include('conference.users.user.Registration elements.schoolFieldOfStudyField')

<div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
<label class="col-md-4 control-label">Do you work for company?:</label>

<div class="col-md-6">
    <div class="radio">
        <label>{!! Form::radio('company', '1', true,['id'=>'company','onchange' => 'displayCompanyForm(this)']) !!}Yes</label>
    </div>
    <div class="radio">
        <label>{!! Form::radio('company', '0', true,['onchange' => 'displayCompanyForm(this)']) !!}No</label>
    </div>
    @if ($errors->has('company'))
        <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                        </span>
    @endif
</div>
</div>
<div id="companyForm" style="display: none;">
    <div class="form-group{{ $errors->has('company_profile') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Business profile:</label>

        <div class="col-md-6">
            {!! Form::text('company_profile',old('company_profile'),['class'=>'form-control']) !!}
            @if ($errors->has('company_profile'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company_profile') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Name of company:</label>

        <div class="col-md-6">
            {!! Form::text('company_name',old('company_name'),['class'=>'form-control']) !!}
            @if ($errors->has('company_name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Address of company:</label>

        <div class="col-md-6">
            {!! Form::text('company_address',old('company_address'),['class'=>'form-control']) !!}
            @if ($errors->has('company_address'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                        </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('company_nip') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">NIP:</label>

        <div class="col-md-6">
            {!! Form::text('company_nip',old('company_nip'),['class'=>'form-control']) !!}
            @if ($errors->has('company_nip'))
                <span class="help-block">
                                        <strong>{{ $errors->first('company_nip') }}</strong>
                        </span>
            @endif
        </div>
    </div>

</div>
<script>
    (function() {
        if(document.getElementById("company").checked==true){
            document.getElementById("companyForm").style.display = "block";
        }
    })();
    function displayCompanyForm(that) {
        if (that.value == "1") {
            document.getElementById("companyForm").style.display = "block";
        } else {
            document.getElementById("companyForm").style.display = "none";
        }
    }
</script>

<div class="form-group{{ $errors->has('facture') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Do you want to get invoice:</label>

    <div class="col-md-6">
        <div class="radio">
            <label>{!! Form::radio('facture', '1', true,['id'=>'facture','onchange' => 'displayFactureField(this)']) !!}Yes</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('facture', '0', true,['onchange' => 'displayFactureField(this)']) !!}No</label>
        </div>
        @if ($errors->has('facture'))
            <span class="help-block">
                                        <strong>{{ $errors->first('facture') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div id="factureField" style="display: none;">
    <div class="form-group{{ $errors->has('facture_information') ? ' has-error' : '' }}">
        <label class="col-md-4 control-label">Invoice details:</label>

        <div class="col-md-6">
            {!! Form::text('facture_information',old('facture_information'),['class'=>'form-control']) !!}
            @if ($errors->has('facture_information'))
                <span class="help-block">
                                        <strong>{{ $errors->first('facture_information') }}</strong>
                        </span>
            @endif
        </div>
    </div>
</div>
<script>
    (function() {
        if(document.getElementById("facture").checked==true){
            document.getElementById("factureField").style.display = "block";
        }
    })();
    function displayFactureField(that) {

        if (that.value == "1") {
            document.getElementById("factureField").style.display = "block";
        } else {
            document.getElementById("factureField").style.display = "none";
        }
    }
</script>