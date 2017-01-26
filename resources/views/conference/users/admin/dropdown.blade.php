
        <li>
            <a href="{{ url('admin_logout') }}"
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ url('admin_logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
