<div class="form-group{{ $errors->has('school') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">School:</label>

    @include('conference.users.user.Registration elements.schoolField')

    @include('conference.users.user.Registration elements.schoolFieldOfStudyField')
<div class="form-group{{ $errors->has('employee_universities') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Are you employee by universities?:</label>

    <div class="col-md-6">
        <div class="radio">
            <label>{!! Form::radio('employee_universities', '1') !!}Yes</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('employee_universities', '0') !!}No</label>
        </div>
        @if ($errors->has('employee_universities'))
            <span class="help-block">
                                        <strong>{{ $errors->first('employee_universities') }}</strong>
                        </span>
        @endif
    </div>
</div>

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
