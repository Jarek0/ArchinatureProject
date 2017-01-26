<div class="form-group{{ $errors->has('school_field_of_study') ? ' has-error' : '' }}">
    <label class="col-md-4 control-label">Field of study:</label>

    <div class="col-md-6">
        <div class="radio">
            <label>{!! Form::radio('school_field_of_study_select', 'Building', true,['id'=>'building','onchange' => 'displaySchoolFieldOfStudyField(this)']) !!}Building</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('school_field_of_study_select', 'Environmental engineering', true,['id'=>'environmental_engineering','onchange' => 'displaySchoolFieldOfStudyField(this)']) !!}Environmental engineering</label>
        </div>
        <div class="radio">
            <label>{!! Form::radio('school_field_of_study_select', 'Other', true,['id'=>'school_field_of_study_select','onchange' => 'displaySchoolFieldOfStudyField(this)']) !!}Other</label>
        </div>
        @if ($errors->has('school_field_of_study'))
            <span class="help-block">
                                        <strong>{{ $errors->first('school_field_of_study') }}</strong>
                        </span>
        @endif
    </div>
</div>
<div class="form-group">
    <div id="schoolFieldOfStudyField" style="display: none;">
        <label class="col-md-4 control-label">Name of field of study:</label>
        <div class="col-md-6"  >
            {!! Form::text('school_field_of_study',old('school_field_of_study'),['class'=>'form-control','id'=>'school_field_of_study']) !!}
        </div>
    </div>
    <script>
        (function() {
            if(document.getElementById("school_field_of_study").value=='Building'){
                document.getElementById("schoolFieldOfStudyField").style.display = "none";
                document.getElementById("building").checked=true;
            }
            else if(document.getElementById("school_field_of_study").value=='Environmental engineering'){
                document.getElementById("schoolFieldOfStudyField").style.display = "none";
                document.getElementById("environmental_engineering").checked=true;
            }
            else if (document.getElementById('school_field_of_study_select').value == "Other") {
                document.getElementById("schoolFieldOfStudyField").style.display = "block";
            }

            else{
                document.getElementById("schoolFieldOfStudyField").style.display = "none";
                document.getElementById("school_field_of_study").value = document.getElementById("school_field_of_study_select").value;

            }
        })();
        function displaySchoolFieldOfStudyField(that) {
            if (that.value == "Other") {
                document.getElementById("schoolFieldOfStudyField").style.display = "block";
                document.getElementById("school_field_of_study").value = "";
            } else {
                document.getElementById("schoolFieldOfStudyField").style.display = "none";
                document.getElementById("school_field_of_study").value = that.value;
            }
        }
    </script>
</div>