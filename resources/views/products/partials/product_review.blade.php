@section('css')
<style>
    .product-item {
        text-align: justify !important;
    }
</style>
@endsection

<div class="row mt-4">
    @forelse ($reviewList as $item)
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                Oleh &nbsp;
                <h4>{{ $item->user->name }}</h4>
                <div class="ml-auto">
                    <span class="font-italic">{{ $item->created_at->format('l, d F Y H:i ') }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-9 col-lg-9">
                        <div class="product-item">
                            <div class="product-details">
                                <div class="product-review">
                                    @for ($i = 0; $i < $item->stars; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                </div>
                            </div>
                        </div>
                        <h5 class="mt-2">{{ $item->body_review }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="empty-state" data-height="200">
                    <img class="img-fluid" src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}"
                        alt="image">
                    <h2 class="mt-0">Oops, ulasan produk kosong</h2>
                </div>
            </div>
        </div>
    </div>
    @endforelse

    <div class="col-12">
        {{ $reviewList->links() }}
    </div>
</div>