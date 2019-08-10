<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item {{ Helpers::setSelected('commodity') }}">
                <a href="{{ route('commodity.index') }}"class="nav-link"><i class="fas fa-tree"></i><span>Komoditas</span></a>
            </li>
            <li class="nav-item {{ Helpers::setSelected('agricultures') }}">
                <a href="{{ route('agricultures.index') }}" class="nav-link"><i class="fas fa-cloud"></i><span>Hasil Pertanian</span></a>
            </li>
            <li class="nav-item {{ Helpers::setSelected('stores') }}">
                <a href="{{ route('stores.index') }}" class="nav-link"><i class="fas fa-store-alt"></i><span>Toko</span></a>
            </li>
        </ul>
    </div>
</nav>