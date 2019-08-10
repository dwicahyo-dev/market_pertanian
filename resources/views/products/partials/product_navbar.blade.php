<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link {{ Helpers::setSelectedSegmentThree('') }}"
            href="{{ route('products.show', $product->id) }}">
            <i class="far fa-clipboard"></i> Informasi Produk
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Helpers::setSelectedSegmentThree('reviews') }}"
            href="{{ route('products.reviews', $product->id) }}">
            <i class="fas fa-star"></i> Ulasan <span class="badge badge-danger">{{ $reviewsCount }}</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ Helpers::setSelectedSegmentThree('discussions') }}"
            href="{{ route('products.discussions', $product->id) }}">
            <i class="fas fa-comments"></i> Diskusi Produk <span
                class="badge badge-danger">{{ $product->productDiscussions->count() }}</span>
        </a>
    </li>
</ul>