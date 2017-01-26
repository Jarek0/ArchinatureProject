<div class="form-group">
    <div  class="col-md-4 control-label">
        {!! Form::label('image','Image:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::file('image',null) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit($buttonText,['class'=>'btn btn-primary']) !!}
    </div>
</div>