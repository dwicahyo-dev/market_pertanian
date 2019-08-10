<div class="card">
    <div class="card-header">
        <h4>Filter Produk</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('agricultures.filter', $agriculture->id) }}">

            <div class="form-group">
                <label for="inputEmail4">Kualitas Produk</label>
                <select name="quality" class="form-control selectric">
                    @foreach ($qualities as $quality)
                    <option value="{{ $quality->id }}">{{ $quality->quality_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="inputEmail4">Harga Produk</label>
                <select name="price" class="form-control selectric">
                    <option value="highest">Harga Tertinggi</option>
                    <option value="lowest">Harga Terendah</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Terapkan</button>
            <a href="{{ route('agricultures.show', $agriculture->id) }}"
                class="btn btn-outline-danger btn-block">Reset</a>
        </form>
    </div>
</div>