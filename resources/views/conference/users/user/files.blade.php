@extends('conference.users.index')
@section('articles')

    @include('form_errors')
        <div class="panel custom-panel dropbtn">
            <div class="panel-heading">Your theses</div>

            <div class="panel-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>Kind</th>
                        <th>Last version</th>
                        <th>Data</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>presentation</td>
                            <td>
                                @if(!empty($presentation->name))
                                    {{ \Illuminate\Support\Str::limit($presentation->name, 25) }}
                                @else
                                    empty
                                @endif
                            </td>
                            <td>
                                @if(!empty($presentation->updated_at))
                                    {{$presentation->updated_at->format('Y-m-d')}}
                                    @else
                                    empty
                                @endif

                            </td>
                            <td>
                                <div class="btn-group">
                                    @if(!empty($presentation->path))
                                    <a  type="button" class="btn btn-success" href="{{action('UserController@downloadPresentation')}}">Download</a>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>

                                                <a onclick='choosePresentation();'>Change</a>

                                        </li>
                                        <li>
                                                <a  href="{{action('UserController@deletePresentation')}}">Delete</a>
                                        </li>
                                    </ul>
                                    @else
                                        <button type="button" name="button" class="btn btn-success" onClick="choosePresentation();">Upload</button>
                                    @endif
                                </div>
                                {!! Form::model(null,['method'=>'POST','files' => true,'class'=>'form-horizontal','name'=>"presentationForm",'action'=>['UserController@uploadPresentation']]) !!}

                                <input type="file" onchange="document.forms['presentationForm'].submit()" id="presentationFile" name="presentation" style="display: none;" />

                                {!! Form::close() !!}
                                <script>
                                    function choosePresentation() {
                                        $("#presentationFile").click();
                                    }
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>summary</td>
                            <td>
                                @if(!empty($summary->name))
                                    {{ \Illuminate\Support\Str::limit($summary->name, 25) }}
                                @else
                                    empty
                                @endif
                            </td>
                            <td>
                                @if(!empty($summary->updated_at))
                                    {{$summary->updated_at->format('Y-m-d')}}
                                @else
                                    empty
                                @endif

                            </td>
                            <td>
                                <div class="btn-group">
                                    @if(!empty($summary->path))
                                        <a type="button" class="btn btn-success" href="{{action('UserController@downloadSummary')}}">Download</a>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a  onclick="chooseSummary();">Change</a>

                                            </li>
                                            <li>
                                                <a  href="{{action('UserController@deleteSummary')}}">Delete</a>
                                            </li>
                                        </ul>
                                    @else
                                        {!! Form::model(null,['method'=>'POST','files' => true,'class'=>'form-horizontal','name'=>"summaryForm",'action'=>['UserController@uploadSummary']]) !!}
                                        <button type="button" name="button" class="btn btn-success" onClick="chooseSummary();">Upload</button>
                                        <input type="file" onchange="document.forms['summaryForm'].submit()" id="summaryFile" name="summary" style="display: none;" />
                                        <script type='text/javascript'>
                                            function chooseSummary() {
                                                $("#summaryFile").click();
                                            }
                                        </script>
                                        {!! Form::close() !!}

                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>poliforum</td>
                            <td>
                                @if(!empty($poliforum->name))
                                    {{ \Illuminate\Support\Str::limit($poliforum->name, 25) }}
                                @else
                                    empty
                                @endif
                            </td>
                            <td>
                                @if(!empty($poliforum->updated_at))
                                    {{$poliforum->updated_at->format('Y-m-d')}}
                                @else
                                    empty
                                @endif

                            </td>
                            <td>
                                <div class="btn-group">
                                    @if(!empty($poliforum->path))
                                        <a type="button" class="btn btn-success" href="{{action('UserController@downloadPoliforum')}}">Download</a>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>

                                                <a  onclick="choosePoliforum();">Change</a>

                                            </li>
                                            <li>
                                                <a  href="{{action('UserController@deletePoliforum')}}">Delete</a>
                                            </li>
                                        </ul>
                                    @else
                                        {!! Form::model(null,['method'=>'POST','files' => true,'class'=>'form-horizontal','name'=>"poliforumForm",'action'=>['UserController@uploadPoliforum']]) !!}
                                        <button type="button" name="button" class="btn btn-success" onClick="choosePoliforum();">Upload</button>
                                        <input type="file" onchange="document.forms['poliforumForm'].submit()" id="poliforumFile" name="poliforum" style="display: none;" />
                                        <script type='text/javascript'>
                                            function choosePoliforum() {
                                                $("#poliforumFile").click();
                                            }
                                        </script>
                                        {!! Form::close() !!}

                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>


@endsection