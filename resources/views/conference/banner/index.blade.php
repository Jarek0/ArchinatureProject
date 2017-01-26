

    @if(Session::has('conference_id'))
            @if(!empty($conferences))
                @foreach($conferences as $conference)
                    @if(Session::get('conference_id')==$conference->id)

                        <a href="/"><img src="{{ asset($conference->banner->path) }}" class="img-responsive" style="width:100%" alt="Image"></a>

                        @break
                    @endif
                @endforeach
            @endif
    @endif