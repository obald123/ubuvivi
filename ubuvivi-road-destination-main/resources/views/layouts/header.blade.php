<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">
    <a href="{{ url('logout') }}" class="has-icon btn btn-light shadow"
        onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
        {{ csrf_field() }}
    </form>
</ul>
