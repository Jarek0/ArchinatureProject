<div class="form-group">
    <div  class="col-md-4 control-label">
        {!! Form::label('name','Name:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit($buttonText,['class'=>'btn btn-primary']) !!}
    </div>
</div>