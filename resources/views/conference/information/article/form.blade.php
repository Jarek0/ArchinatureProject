



<div class="form-group">
    <div  class="col-md-2 control-label">
        {!! Form::label('title','Title:') !!}
    </div>
    <div class="col-md-6">
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    <div  class="col-md-2 control-label">
        {!! Form::label('content','Content:') !!}
    </div>
    <div class="col-md-10 ">
        {!! Form::textarea('content',null,['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        {!! Form::submit($buttonText,['class'=>'btn btn-primary']) !!}
    </div>
</div>
