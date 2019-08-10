<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="{{ url('/') }}" class="navbar-brand sidebar-gone-hide">Market Pertanian</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    @include('partials.navbar_search')


    <ul class="navbar-nav navbar-right">
    @include('partials.navbar_component')
    @include('partials.navbar_register_login_component')
    @include('partials.navbar_profile')

    </ul>
</nav>
    @include('partials.navbar_item')