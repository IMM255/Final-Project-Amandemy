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
                    <div class="col-md-7 mt-1 text-center hero-text">
                        <h1 data-aos="fade-up" data-aos-delay="">Buat Pengaduan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mb-5 d-flex justify-content-center">
        <div class="col-md-12 p-4">
            <div class="card" style="background: #e4e4e4">
                <form action="{{ route('pengaduan.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Judul Laporan Anda*</label>
                                    <input type="text"
                                        class="form-control border border-dark rounded-lg @error('deskripsi') ? is-invalid @enderror"
                                        name="title">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tulis Pengaduan Anda*</label>
                                    <textarea name="description"
                                        class="form-control border border-dark rounded-lg @error('deskripsi') ? is-invalid @enderror"
                                        rows="10" style="width: 100%" required></textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tingkat Urgensi*</label>
                                    <select name="urgency" class="form-control border border-dark rounded-lg" required>
                                        <option value="{{ null }}" disabled selected>-- PILIH Tingkat Urgensi</option>
                                        <option value="tinggi">tinggi</option>
                                        <option value="sedang">Sedang</option>
                                        <option value="rendah">rendah</option>
                                    </select>
                                    @error('urgency')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <label>Kategori Pengaduan*</label>
                                    <select name="kategori" class="form-control border border-dark rounded-lg" required>
                                        <option value="{{ null }}" disabled selected>-- PILIH --</option>
                                        <option value="1">Pencemaran udara, air, atau tanah</option>
                                        <option value="2">Gangguan ketertiban umum</option>
                                        <option value="3">Bantuan sosial yang tidak tepat sasaran</option>
                                        <option value="4">Kondisi rumah yang tidak layak huni</option>
                                        <option value="5">Masalah dengan layanan telekomunikasi atau internet</option>
                                        <option value="6">Masalah dengan penyediaan air bersih dan listrik</option>
                                        @foreach ($categories as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name_category }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <input type="text"
                                        class="form-control border border-dark rounded-lg @error('location') ? is-invalid @enderror"
                                        name="location">
                                    @error('location')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Image*</label>
                                    <input type="file" class="form-control border border-dark rounded-lg" name="image"
                                        required>
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-4">
                                <button class="btn btn-primary" type="submit">
                                    <span class="fa fa-paper-plane"></span>
                                    Buat Pengaduan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
