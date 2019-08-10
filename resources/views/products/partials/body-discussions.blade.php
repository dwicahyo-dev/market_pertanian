<div class="row mt-4">
    <div class="col-12">
        @include('partials.alert_success')
    </div>

    @forelse ($productDiscussions as $discussion)
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ Helpers::showStoreName($product, $discussion) }}
                    {{ Helpers::showIfSeller($product, $discussion)}}</h4>
                @can('view', $discussion)
                <div class="card-header-action">
                    <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="btn btn-primary "><i class="fas fa-cog"></i></a>
                        <div class="dropdown-menu">
                            <a href="{{ route('products.discussions.edit', ['product' => $product->id, 'product_discussion' => $discussion->id]) }}"
                                class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>

                            <div class="dropdown-divider"></div>

                            <a href="javascript:void(0)" onclick="deleteDiscussion({{ $discussion->id }})"
                                class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
            <div class="card-body">
                <p>{{ $discussion->body }}</p>
            </div>
            <div class="card-footer bg-light">
                <span class="text-dark">{{ $discussion->created_at->format('d M Y H:i') }}</span>
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
                    <h2 class="mt-0">Oops, diskusi produk kosong</h2>
                </div>
            </div>
        </div>
    </div>

    @endforelse

    <div class="col-12">
        {{ $productDiscussions->links() }}
    </div>

    <div class="mt-2 col-12 col-md-12 col-lg-12">
        <hr>
        <div class="card mt-4 card-primary">
            <div class="card-header">
                <h4>Mulai Diskusi</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('product_discussions.store') }}" method="post">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="form-group ">
                        <input type="text" name="body"
                            class="form-control {{ $errors->has('body') ? ' is-invalid' : '' }}"
                            placeholder="Apa yang ingin Anda tanyakan mengenai produk ini ?">

                        @if ($errors->has('body'))
                        <div class="invalid-feedback">
                            {{ $errors->first('body') }}
                        </div>
                        @endif
                    </div>
                    <div class="float-right">
                        <button class="btn btn-primary mr-1" type="submit">Kirim</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

@section('script')
<script>
    $(document).ready(function () {
        let quantitiy=0;
        let max;

        $('.quantity-right-plus').click(function(e){
            e.preventDefault();

            let quantity = parseInt($('#quantity').val());

            $("#quantity").attr("max", function(index, currentvalue){
                max = parseInt(currentvalue);
            });

            if (quantity < max) {
                $('#quantity').val(quantity + 1);
            }

        });

        $('.quantity-left-minus').click(function(e){
            e.preventDefault();

            let quantity = parseInt($('#quantity').val());

            if(quantity > 1){
                $('#quantity').val(quantity - 1);
            }
        });
    });
    
    function deleteDiscussion(id){
        let discussion_id = parseInt(id);

        Swal({
			title: 'Apakah Anda Yakin?',
			text: "Ingin Menghapus Data Ini?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus Saja!'
		}).then( result => {
			if (result.value) {
				axios.delete(`delete/${discussion_id}`)
				.then( response => {
					Swal('Terhapus!', `${response.data.message}`,'success')
					.then(() => {
						location.reload();
					})
				})
				.catch( error => {
					console.log(error);
					Swal({
						type: 'error',
						title: 'Oops...',
						text: 'Gagal Menghapus Data',
					})
				});
			}
		});
    }

</script>
@endsection