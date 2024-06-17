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
                            <h1 data-aos="fade-up" data-aos-delay="">Pengaduanku</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            @foreach ($pengaduans as $item)
                <div class="row mb-5 d-flex justify-content-center">
                    <div class="col-md-12 p-4" style="background: #e4e4e4">
                        <div class="row mb-3">
                            <div class="col-6">
                                <img src="{{ Storage::url($item->image) }}" class="card-img-top object-fit-cover" alt="Pollution" style="height: 300px">
                            </div>
                            <div class="col-6 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="row d-flex justify-content-between mb-4">
                                        <h1 class="col">Polusi</h1>

                                        <form action="{{ route('complaint.delete',['complaint' => $item->id ]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="badge badge-danger rounded-lg py-2 px-5">Hapus</button>
                                        </form>

                                    </div>
                                    <h6>{{ $item->description }}</h6>
                                </div>
                                <div>
                                    <p>{{ $item->lokasi }}, {{ date('M d, Y', strtotime($item->created_at)) }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="badge badge-danger rounded-pill px-2 py-1">Penting dan
                                                Mendesak</span>
                                            <span
                                                class="badge badge-success rounded-pill px-2 py-1">{{ $item->category->name_category }}</span>
                                        </div>
                                        <span
                                            class="badge badge-warning text-white rounded-pill px-2 py-1">{{ $item->status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 pt-3 border-top border-dark">
                            <div class="mx-2">
                                <i class="fa fa-arrow-up"></i> 30 Mendukung
                            </div>
                            <div class="mx-2">
                                <i class="fa fa-arrow-down"></i> 30 Menolak
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
