<div class="card">
    <div class="card-header">
        <h4>Etalase Hasil Pertanian</h4>
    </div>
    <div class="card-body" id="top-5-scroll">
        <ul class="nav nav-pills flex-column list-inline list-unstyled-border">
            @forelse ($agriculturesFront as $front)
            <li class="nav-item">
                <a href="{{ route('stores.front', [$store->id, $front->agriculture->id]) }}"
                    class="nav-link {{ Helpers::setSelectedSegmentStoreFront($front->agriculture->id) }}">{{ $front->agriculture->agriculture_name }}</a>
            </li>
            @empty
            <img class="img-responsive mx-auto d-block" width="170"
                src="{{ asset('assets/img/drawkit/drawkit-nature-man-colour.svg') }}" alt="image">
            <div class="empty-state" data-height="80">
                <h2 class="mt-0">Oops, etalase kosong</h2>
            </div>
            @endforelse
        </ul>
    </div>
</div>