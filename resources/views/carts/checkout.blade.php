@extends('layouts.app')
@section('title', 'Checkout')
@section('content')

<checkout-component :cart="{{ $cart }}" :addresses="{{ $addresses }}"></checkout-component>

@endsection

@section('script')
<script
    src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
@endsection