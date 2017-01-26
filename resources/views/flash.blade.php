@if(Session::has('success'))
    <div class="alert alert-success card">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('fail'))
    <div class="alert alert-success card">
        {{Session::get('fail')}}
    </div>
@endif