@extends('layouts.guest')
@section('content')
    <div class="hero-section inner-page">
        <div class="wave">
            <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                        <path
                            d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z"
                            id="Path"></path>
                    </g>
                </g>
            </svg>
        </div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center hero-text">
                            <h1 data-aos="fade-up" data-aos-delay="">Selamat Datang {{ $user->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-md-12 p-4">
                <div class="card p-4" style="background: #e4e4e4">
                    <form action="{{ route('profile.update',['profile' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name"
                                    class="form-control border border-dark rounded-lg @error('name') ? is-invalid @enderror"
                                    value="{{ $user->name }}" required="">
                                @error('name')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Telepon</label>
                                <input type="text" name="phone"
                                    class="form-control border border-dark rounded-lg @error('telp') ? is-invalid @enderror"
                                    value="{{ $user->phone }}">
                                @error('phone')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control border border-dark rounded-lg @error('email') ? is-invalid @enderror"
                                    value="{{ $user->email }}" required="">
                                @error('email')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-12 col-12">
                                <label>Alamat</label>
                                <textarea rows="5" class="form-control border border-dark rounded-lg @error('alamat') ? is-invalid @enderror"
                                    name="address">{{ $user->address }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Image</label>
                                <input type="file" name="image"
                                    class="form-control border border-dark rounded-lg  @error('image') ? is-invalid @enderror ">
                                @error('image')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <button class="btn btn-primary" type="submit">Perbarui Profile</button>
                            </div>
                        </div>
                    </form>
                    <h2>Ganti Password</h2>
                    <form action="{{ route('profile.update',['profile' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="address" value="{{ $user->address }}">
                        <input type="hidden" name="name" value="{{ $user->name }}">
                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Password</label>
                                        <input type="password" name="password"
                                            class="form-control border border-dark rounded-lg @error('password') ? is-invalid @enderror"
                                            value="">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Confirm Password</label>
                                        <input type="password" name="password_confirmation"
                                            class="form-control border border-dark rounded-lg" value="">
                                    </div>
                                    <div class="col-12">
                                        <div class="row d-flex justify-content-center">
                                            <div class="form-group col-8">
                                                <button class="btn btn-primary w-100" type="submit">Perbarui
                                                    Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
