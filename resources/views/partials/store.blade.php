<li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link  nav-link-lg nav-link-user">
        <i class="fas fa-store-alt"></i>
        @isset(Auth::user()->store)
        <div class="d-sm-none d-lg-inline-block">&ensp;{{ Auth::user()->store->store_name }}</div>
        @endisset
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Toko
            @isset(Auth::user()->store)
            <div class="float-right">
                <a href="{{ route('products.manage-product.stocked') }}" class="btn btn-primary btn-block">Daftar
                    Produk</a>
            </div>
            @endisset
        </div>

        @empty(Auth::user()->store)
        <div class="dropdown-footer text-center">
            <p>Anda belum memiliki Toko </p>
            <a href="{{ route('stores.create') }}" class="btn btn-primary btn-block">Buka Toko</a>
        </div>
        @else
        <a href="{{ route('stores.show', Auth::user()->store->id) }}" class="dropdown-item dropdown-item-read">
            <div class="dropdown-item-avatar">
                @isset(Auth::user()->store->thumbnail)
                <img alt="image" src="{{ Storage::url('public/stores/'. Auth::user()->store->thumbnail) }}"
                    class="rounded-circle">
                @else
                <figure class="avatar mr-2 avatar-sm bg-info text-white"
                    data-initial="{{ substr(Auth::user()->store->store_name, 0, 2)  }}">
                </figure>
                @endisset
            </div>
            <div class="dropdown-item-desc">
                <b>{{ Auth::user()->store->store_name }}</b>
                <p>Buka sejak : {{ Auth::user()->store->created_at->format('d M Y') }}</p>
            </div>
        </a>

        {{-- <div class="dropdown-footer text-center">
            <a href="{{ route('settings.store') }}" class="btn btn-outline-primary btn-block">Pengaturan Toko</a>
    </div> --}}
    @endempty
    </div>
</li>