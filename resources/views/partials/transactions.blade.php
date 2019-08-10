<li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg {{ Auth::user()->beep() }}">
        <i class="fas fa-exchange-alt"></i>
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Transaksi
            <div class="float-right">
                <span class="badge badge-primary">
                    {{ Auth::user()->countTransactions() }}
                </span>
            </div>
        </div>
        <div class="dropdown-footer text-center">
            <a href="{{ route('checkout.invoice') }}">Lihat semua Transaksi <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</li>