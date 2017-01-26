
    <div class="sponsors">



    @if(Session::has('conference_id'))
        @if(!empty($conferences))
        @foreach($conferences as $conference)
            @if(Session::get('conference_id')==$conference->id)
                @foreach($conference->sponsorsCategories as $sponsorsCategory)

                        <div class="title-label dropdown">

                            <p class="dropbtn">{{$sponsorsCategory->name}}</p>
                            @if (Auth::guard("admin")->user())
                            <div class="dropdown-content">
                                <a href="{{ action('SponsorsCategoriesController@edit', ['conference_id'=>$sponsorsCategory->conference->id,'sponsor_category_id'=>$sponsorsCategory->id]) }}" class="glyphicon glyphicon-wrench"></a>
                                <a href="{{ action('SponsorsCategoriesController@delete', ['conference_id'=>$sponsorsCategory->conference->id,'sponsor_category_id'=>$sponsorsCategory->id]) }}" class="glyphicon glyphicon-trash"></a>
                                <a href="{{ action('SponsorsController@create', ['conference_id'=>$sponsorsCategory->conference->id,'sponsor_category_id'=>$sponsorsCategory->id]) }}" class="glyphicon glyphicon-plus"></a>

                            </div>
                            @endif
                        </div>
                    @foreach($sponsorsCategory->sponsors as $sponsor)
                                <div class="dropdown">
                                <a class="sponsor-item dropbtn" href="{{ asset($sponsor->website_link) }}"><img src="{{ asset($sponsor->image_path) }}" class="sponsor-image" alt="Sponsor"></a>
                                @if (Auth::guard("admin")->user())
                                <div class="dropdown-content">
                                    <a href="{{ action('SponsorsController@edit', ['conference_id'=>$sponsorsCategory->conference->id,'sponsor_category_id'=>$sponsorsCategory->id,'sponsor_id'=>$sponsor->id]) }}" class="glyphicon glyphicon-wrench"></a>
                                    <a href="{{ action('SponsorsController@delete', ['conference_id'=>$sponsorsCategory->conference->id,'sponsor_category_id'=>$sponsorsCategory->id,'sponsor_id'=>$sponsor->id]) }}" class="glyphicon glyphicon-trash"></a>
                                </div>
                                @endif
                                </div>
                    @endforeach
                @endforeach
            @break
            @endif
        @endforeach
        @endif
    @endif

    </div>
