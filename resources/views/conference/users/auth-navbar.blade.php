<nav class="navbar navbar-inverse navbar-fixed-top navbar-custom" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/archinature_logo.png') }}" alt="Archinature"/>
            </a>


        </div>
        <ul class = "nav navbar-nav" >
        @if (Auth::guard("admin")->user())
            @include('conference.users.admin.dropdown')
        @endif
        </ul>
    </div>
</nav>