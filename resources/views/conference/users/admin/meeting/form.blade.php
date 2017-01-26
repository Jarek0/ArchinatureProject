



<div class="form-group">
    <div  class="col-md-2 control-label">
        {!! Form::label('date','Date:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::date('date', \Carbon\Carbon::now(),['class'=>'form-control']) !!}

    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit($buttonText,['class'=>'btn btn-primary']) !!}
    </div>
</div>
