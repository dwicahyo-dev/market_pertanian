@extends('layouts.app')
@section('title', 'Verifikasi Email') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Verifikasi alamat email Anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-primary" role="alert">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
                    {{ __('Jika Anda tidak menerima email') }}, <a href="{{ route('verification.resend') }}">{{ __('klik di sini untuk meminta yang lain') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
