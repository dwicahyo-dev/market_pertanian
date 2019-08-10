@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Profile</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, {{ $user->name }}</h2>
        <p class="section-lead">Ganti informasi tentang Anda pada halaman ini.</p>

        <div class="row mt-sm-4">

            <div class="col-12 col-md-12 col-lg-12">

                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <figure class="profile-widget-picture avatar  avatar-xl  bg-primary text-white"
                            data-initial="{{ substr(Auth::user()->name, 0, 2)  }}"></figure>
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Nama Anda</div>
                                <div class="profile-widget-item-value">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Email</div>
                                <div class="profile-widget-item-value">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-12">
                @include('partials.alert_success')

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        @include('partials.error_alert')

                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab3" data-toggle="tab" href="#profile"
                                    role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab"
                                    aria-controls="contact" aria-selected="false">Password</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab3">
                                <form method="POST" action="{{ route('user.update', $user->id) }}">
                                    @csrf
                                    @method("PATCH")

                                    <div class="form-group ">
                                        <label>Nama</label>
                                        <input type="text" name="name"
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            value="{{ $user->name }}" placeholder="Nama Anda">
                                    </div>
                                    <div class="form-group ">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ $user->email }}" placeholder="Alamat E-Mail Anda">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="gender" value="male" class="selectgroup-input"
                                                    {{ isset($user) && $user->gender === 'male' ? 'checked' : '' }}>
                                                <span class="selectgroup-button selectgroup-button-icon"
                                                    data-toggle="tooltip" data-placement="bottom" title="Laki-laki"><i
                                                        class="fas fa-male"></i></span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="gender" value="female"
                                                    class="selectgroup-input"
                                                    {{ isset($user) && $user->gender === 'female' ? 'checked' : '' }}>
                                                <span class="selectgroup-button selectgroup-button-icon"
                                                    data-toggle="tooltip" data-placement="bottom" title="Perempuan"><i
                                                        class="fas fa-female"></i></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Nomor HP</label>
                                        <input type="text" name="phonenumber"
                                            class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                            value="{{ $user->phonenumber }}" placeholder="Nomor HP">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mr-1">Update</button>
                                        <a href="{{ route('home') }}" role="button" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>

                            </div>

                            {{-- Password --}}
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <form method="POST" action="{{ route('profile.password.update') }}">
                                    @csrf @method("PATCH")

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="confirm_password"
                                            class="form-control {{ $errors->has('confirm_password') ? ' is-invalid' : '' }}"
                                            placeholder="Konfirmasi Password">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary mr-1">Update</button>
                                        <a href="{{ route('home') }}" role="button" class="btn btn-danger">Batal</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
@endsection