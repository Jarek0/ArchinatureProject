<div class="col-md-6" >
    <div class="styled-select">
        {!!
                Form::select(
                'school_select',
                array(
                'Politechnika Poznańska' => 'Politechnika Poznańska',
                'Akademika Górniczo-Hutnicza im. Stanisława Staszica' => 'Akademika Górniczo-Hutnicza im. Stanisława Staszica',
                'Politechnika Białostocka' => 'Politechnika Białostocka',
                'Politechnika Częstochowska' => 'Politechnika Częstochowska',
                'Politechnika Gdańska' => 'Politechnika Gdańska',
                'Politechnika Koszalińska' => 'Politechnika Koszalińska',
                'Politechnika Krakowska im. Tadeusza Kościuszki' => 'Politechnika Krakowska im. Tadeusza Kościuszki',
                'Politechnika Lubelska' => 'Politechnika Lubelska',
                'Politechnika Łódzka' => 'Politechnika Łódzka',
                'Politechnika Opolska' => 'Politechnika Opolska',
                'Politechnika Rzeszowska im. Ignacego Łukasiewicza' => 'Politechnika Rzeszowska im. Ignacego Łukasiewicza',
                'Politechnika Śląska w Gliwicach' => 'Politechnika Śląska w Gliwicach',
                'Politechnika Świętokrzyska w Kielcach' => 'Politechnika Świętokrzyska w Kielcach',
                'Politechnika Warszawska' => 'Politechnika Warszawska',
                'Politechnika Wrocławska' => 'Politechnika Wrocławska',
                'Uniwersytet Technologiczno-Przyrodniczy w Bydgoszczy' => 'Uniwersytet Technologiczno-Przyrodniczy w Bydgoszczy',
                'Wojskowa Akademia Techniczna im. Jarosława Dąbrowskiego' => 'Wojskowa Akademia Techniczna im. Jarosława Dąbrowskiego',
                'Zachodniopomorski Uniwersytet Technologiczny w Szczecinie' => 'Zachodniopomorski Uniwersytet Technologiczny w Szczecinie',
                'Other' => 'Other'
                ),
                'default',
                array('id' => 'school_select','onchange' => 'displaySchoolField(this)'))
         !!}
    </div>
    @if ($errors->has('school'))
        <span class="help-block">
                 <strong>{{ $errors->first('school') }}</strong>
            </span>
    @endif
</div>
</div>
<div class="form-group">
    <div id="schoolField" style="display: none;">
        <label class="col-md-4 control-label" >Name of school:</label>
        <div class="col-md-6"  >
            {!! Form::text('school',null,['class'=>'form-control','id'=>"school"]) !!}
        </div>
    </div>
    <script>
        (function() {

            if (document.getElementById("school_select").value == "Other") {
                document.getElementById("schoolField").style.display = "block";
            }
            else if(document.getElementById("school").value!="")
                {
                    document.getElementById("school_select").value = document.getElementById("school").value;
                    document.getElementById("schoolField").style.display = "block";
            }
            else{
                document.getElementById("school").value  = document.getElementById("school_select").value;
            }
        })();

        function displaySchoolField(that) {
            if (that.value == "Other") {
                document.getElementById("school").value = "";
                document.getElementById("schoolField").style.display = "block";
            } else {
                document.getElementById("schoolField").style.display = "none";
                document.getElementById("school").value = that.value;
            }
        }
    </script>
</div>