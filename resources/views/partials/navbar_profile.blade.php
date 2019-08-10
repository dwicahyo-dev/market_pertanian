@auth
<li class="dropdown">
  <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
    <figure class="avatar mr-2 avatar-sm bg-info text-white" data-initial="{{ substr(Auth::user()->name, 0, 2)  }}">
    </figure>
    <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
  </a>
  <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-title">Selamat Datang</div>
    <a href="{{ route('user.index') }}" class="dropdown-item has-icon">
      <i class="far fa-user"></i> Profile
    </a>
    {{-- <a href="features-activities.html" class="dropdown-item has-icon">
      <i class="fas fa-bolt"></i> Activities
    </a> --}}
    <a href="{{ route('setting.index') }}" class="dropdown-item has-icon">
      <i class="fas fa-cog"></i> Pengaturan
    </a>

    <div class="dropdown-divider"></div>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
      class="dropdown-item has-icon text-danger">
      <i class="fas fa-sign-out-alt"></i> Keluar
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>
</li>
@endauth