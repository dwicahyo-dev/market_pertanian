<div class="card card-primary">
    <div class="card-header">
        <h4>Informasi Toko</h4>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{{ route('stores.show', $product->store->id) }}" class="nav-link">
                    <div class="d-flex justify-content-center">
                        @isset($product->store->thumbnail)
                        <figure class="avatar m-auto avatar-xl bg-light">
                            <img src="{{ asset('storage/stores/'.$product->store->thumbnail) }}" alt="...">
                        </figure>
                        @else
                        <figure class="avatar avatar-xl bg-info text-white"
                            data-initial="{{ substr($product->store->store_name, 0, 2)  }}">
                        </figure>
                        @endisset
                    </div>
                </a>

            </li>
            <li class="nav-item"><a href="javascript:void(0)" class="nav-link active mt-2"> <i class="fas fa-store"></i>
                    {{ $product->store->store_name }}</a></li>
            <li class="nav-item"><a href="javascript:void(0)" class="nav-link active mt-2"><i
                        class="fas fa-map-marker-alt"></i> {{ $product->store->city->type }}
                    {{ $product->store->city->city_name }}</a></li>
            <li class="nav-item"><a href="javascript:void(0)" class="nav-link active mt-2"><i class="fas fa-clock"></i>
                    Buka sejak :
                    {{ $product->store->created_at->format('d, M Y') }}</a></li>
        </ul>
    </div>
</div>