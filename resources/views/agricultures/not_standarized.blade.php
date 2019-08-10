@extends('layouts.app')
@section('title', 'Hasil Pertanian')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('agricultures.index') }}" class="btn btn-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1>{{ $agriculture->agriculture_name }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ route('agricultures.index') }}">Hasil Pertanian</a></div>
            <div class="breadcrumb-item">{{ $agriculture->agriculture_name }}</div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection