<li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown"
        class="nav-link nav-link-lg message-toggle {{ (Auth::user()->carts->count() >= 1) ? 'beep' : '' }}">
        <i class="fas fa-shopping-cart"></i>

    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Keranjang Belanja
            <div class="float-right">
                <span class="badge badge-primary">{{ Auth::user()->carts->count() }}</span>
            </div>
        </div>
        <div class="dropdown-list-content dropdown-list-message">
            @forelse (Auth::user()->carts as $cart)
            <a href="{{ route('carts.checkout', $cart->id) }}" class="dropdown-item dropdown-item-unread">
                <div class="dropdown-item-avatar">
                    <img alt="image" src="{{ Storage::url('/products/'.$cart->product->thumbnail) }}"
                        class="rounded-circle">
                </div>
                <div class="dropdown-item-desc">
                    <b>{{ $cart->product->product_name }}</b>
                    <p>{{ $cart->product->quality->quality_name }}</p>
                    <div class="time">{{ $cart->qty }} Kg</div>
                </div>
            </a>
            @empty

            @endforelse
        </div>
        <div class="dropdown-footer text-center">
            <a href="{{ route('carts.index') }}">Lihat Semua <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>