@isset($store->cover)
<div class="hero text-white hero-bg-image hero-bg-parallax" data-height="300"
    data-background="{{ Storage::url('stores_cover/'. $store->cover) }}">
    <div class="hero-inner">
        @can('update', $store)
        <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-primary mb-3"><i class="fas fa-cog"></i>
            Ubah</a>
        @endcan

        <h2>{{ $store->store_name }}</h2>

        @isset($store->slogan)
        <p class="lead">
            <i class="fas fa-quote-left"></i> <em>{{ $store->slogan }}</em>
        </p>
        @endisset
    </div>
</div>

@else
<div class="hero bg-primary text-white">
    <div class="hero-inner">
        @can('update', $store)
        <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-outline-light mb-3"><i class="fas fa-cog"></i>
            Ubah</a>
        @endcan

        <h2>{{ $store->store_name }}</h2>

        @isset($store->slogan)
        <p class="lead">
            <i class="fas fa-quote-left"></i> <em>{{ $store->slogan }}</em>
        </p>
        @endisset
    </div>
</div>
@endisset

<div class="card">
    <div class="card-body">
        <div class="float-left mr-3">
            @isset($store->thumbnail)
            <figure class="avatar mr-2 avatar-xl bg-light">
                <img src="{{ Storage::url('stores/'. $store->thumbnail) }}" class="rounded-circle">
            </figure>
            @else
            <figure class="avatar mr-2 avatar-xl bg-info text-white"
                data-initial="{{ substr($store->store_name, 0, 2)  }}">
            </figure>
            @endisset
        </div>
        <div class="">
            <h5 class="card-title">{{ $store->store_name }}</h5>
            <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $store->city->type }}
                {{ $store->city->city_name }}</p>
        </div>
    </div>

    <div class="card-footer bg-whitesmoke">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link {{ Helpers::setSelectedSegmentThree('storefront') }}"
                    href="{{ route('stores.show', $store->id) }}">Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Helpers::setSelectedSegmentThree('review') }}"
                    href="{{ route('stores.review', $store->id) }}">Ulasan
                    <span class="badge badge-danger">{{ $countRev }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Helpers::setSelectedSegmentThree('info') }}"
                    href="{{ route('stores.information', $store->id) }}">Informasi Toko
                </a>
            </li>
        </ul>
    </div>
</div>