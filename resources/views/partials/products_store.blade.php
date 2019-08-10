<div class="row">
    @forelse($products as $product)
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

{{ $products->links() }}