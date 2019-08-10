<div class="col-12">
    <div class="card mb-0">
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link {{ Helpers::setSelectedSegmentTwo('invoices') }}"
                        href="{{ route('checkout.invoice') }}">Pembelian <span
                            class="badge badge-danger">{{ $countInvoice }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Helpers::setSelectedSegmentTwo('transactions') }}"
                        href="{{ route('checkout.transactions') }}">Penjualan <span
                            class="badge badge-danger">{{ $countTransactions }}</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>