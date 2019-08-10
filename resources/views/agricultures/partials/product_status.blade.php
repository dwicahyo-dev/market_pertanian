<div class="card">
    <div class="card-header">
        <h4>Status Produk</h4>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Stok tersedia
                <span
                    class="badge badge-primary badge-pill">{{ $inStock }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Stok tidak tersedia
                <span
                    class="badge badge-primary badge-pill">{{ $outStock }}</span>
            </li>

            <li class="list-group-item d-flex justify-content-between align-items-center">
                Tidak berdasarkan standar harga
                <span class="badge badge-primary badge-pill">{{ $productNotStandardized->count() }}</span>
            </li>
        </ul>
    </div>
</div>