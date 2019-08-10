@if (session()->has('error'))
<div class="alert alert-danger alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
    <div class="alert-body">
        {{ session()->get('error') }}

        @if (session()->has('e'))
        <a href="{{ route('carts.edit', $cart->id) }}" class="badge badge-primary">Klik disini untuk mengubah.</a>
        @endif
    </div>
</div>
@endif