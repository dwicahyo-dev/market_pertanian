<div class="row">
    @forelse($prs as $product)
    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
        <a href="{{ route('products.show', $product->id) }}">
            <article class="article article-style-c">
                <div class="article-header">
                    <div class="article-image" data-background="{{ Storage::url('products/'. $product->thumbnail) }}">
                    </div>
                    <div class="article-badge">
                        <div class="article-badge-item bg-primary"><i class="fas fa-fire"></i> Kualitas
                            {{ $product->quality->quality_name }}
                        </div>
                    </div>
                </div>
                <div class="article-details">
                    <div class="article-category">
                        @if ($product->product_status == true)
                        <a href="javascript:void(0)">Stok :
                            {{ RupiahHelper::formatProduct($product->stock)  }} kg
                        </a>
                        <div class="bullet"></div>
                        @endif
                        <a href="javascript:void(0)">{{ $product->updated_at->diffForHumans() }}</a>
                    </div>
                    <div class="article-title">
                        <h2><a href="{{ route('products.show', $product->id) }}">{{ $product->product_name }}</a>
                        </h2>
                        <p class="text-danger">{{ RupiahHelper::format($product->price) }}/Kg</p>
                    </div>
                    <div class="article-user">
                        @isset($product->store->thumbnail)
                        <img alt="image" src="{{ Storage::url('stores/'. $product->store->thumbnail) }}">
                        @else
                        <figure class="avatar avatar-lg bg-info text-white"
                            data-initial="{{ substr($product->store->store_name, 0, 2)  }}">
                        </figure>
                        @endisset
                        <div class="article-user-details">
                            <div class="user-detail-name">
                                <a
                                    href="{{ route('stores.show', $product->store->id) }}">{{ $product->store->store_name }}</a>
                            </div>
                            <div class="text-job"><i class="fas fa-map-marker-alt"></i>
                                {{ $product->store->city->type }} {{ $product->store->city->city_name }}
                            </div>
                        </div>
                    </div>

                </div>
            </article>
        </a>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="empty-state" data-height="400">
                    <img class="img-fluid" src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                        alt="image">
                    <h2 class="mt-0">Oops, produk kosong</h2>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
<div class="float-right">
    {{ $prs->links() }}
</div>