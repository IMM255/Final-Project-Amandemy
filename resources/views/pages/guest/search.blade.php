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
                        <h1 data-aos="fade-up" data-aos-delay="">Pengaduan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-4">
                    <form class="input-group col-md-5" action="{{ route('search') }}" method="GET">
                        @csrf
                    <input type="text" name="keyword" class="form-control search-input" placeholder="Cari">
                    <div class="input-group-append">
                        <button class="btn  search-icon border" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="row">
                    @if($data->isEmpty())
                        <div class="col-md-12 mb-3">
                            <div class="alert alert-warning" role="alert">
                                Data tidak ditemukan
                            </div>
                        </div>
                    @else
                        @foreach ($data as $item)
                            <div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class=" position-relative">
                                        <img src="{{ Storage::url($item->image) }}" class="card-img-top" alt="Pollution">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title">{{$item->title}}</h5>
                                                <small class="text-muted">{{ $item->location }},
                                                    {{ date('M d, Y', strtotime($item->created_at)) }}</small>
                                            </div>
                                            <p class="card-text">{{ $item->description }}</p>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <span class="badge badge-danger">{{$item->urgency}}</span>
                                                    <span class="badge badge-success">{{$item->category->name_category}}</span>
                                                </div>
                                                <span class="badge badge-warning text-white">{{$item->status}}</span>
                                            </div>
                                            <a class="stretched-link" href="{{ route('pengaduan.detail',['id' => $item->id]) }}"></a>
                                        </div>
                                        </div>
                                        <div class="card-footer text-muted d-flex justify-content-between">
                                            <div class="d-flex">
                                                <form id="vote-form-upvote-{{ $item->id }}" action="{{ route('vote', ['complaint' => $item->id ]) }}" method="POST" class="vote-form">
                                                    @csrf
                                                    <div class="mx-2">
                                                        <button type="button" class=" btn border-none bg-transparent upvote-button" data-type="upvote" data-complaint-id="{{ $item->id }}"
                                                            {{ $item->votes->where('user_id', auth()->id())->where('type', 'upvote')->isNotEmpty() ? 'disabled' : '' }}>
                                                            @if($item->votes->where('user_id', auth()->id())->where('type', 'upvote')->isNotEmpty())
                                                                <i class='bx bxs-upvote'></i> <!-- Filled icon -->
                                                            @else
                                                                <i class='bx bx-upvote'></i> <!-- Outline icon -->
                                                            @endif
                                                            {{ $item->upvotes()->count() }}
                                                            Mendukung
                                                        </button>
                                                    </div>
                                                </form>

                                                <form id="vote-form-downvote-{{ $item->id }}" action="{{ route('vote', ['complaint' => $item->id ]) }}" method="POST" class=" vote-form">
                                                    @csrf
                                                    <div class="mx-2">
                                                        <button type="button" class="btn border-none bg-transparent downvote-button" data-type="downvote" data-complaint-id="{{ $item->id }}"
                                                            {{ $item->votes->where('user_id', auth()->id())->where('type', 'downvote')->isNotEmpty() ? 'disabled' : '' }}>
                                                            @if($item->votes->where('user_id', auth()->id())->where('type', 'downvote')->isNotEmpty())
                                                                <i class='bx bxs-downvote'></i> <!-- Filled icon -->
                                                            @else
                                                                <i class='bx bx-downvote'></i> <!-- Outline icon -->
                                                            @endif
                                                            {{ $item->downvotes()->count() }}
                                                            Menolak
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="row">
                    <h4>Pengaduan terbaru</h4>
                </div>
                @foreach ($topComplaints as $index => $item)
                    <div class="row d-flex mb-1">
                        <div class="col-1">
                            {{ $loop->iteration }}
                        </div>
                        <div class="col-3 px-1">
                            <img src="{{ Storage::url($item->image) }}" class="img-fluid w-100 object-fit-cover " style="height: 100px"
                                alt="Pollution">
                        </div>
                        <div class="col-8 p-0">
                            <h5>{{$item->title}}</h5>
                            <p class="small">{{ Str::limit($item->description, 50) }}</p>
                            <p class="small">{{ $item->location }}, {{ date('M d, Y', strtotime($item->created_at)) }}</p>
                            <a class="stretched-link" href="{{route('pengaduan.detail',$item->id)}}"></a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

{{-- @if ($data->hasPages())
    {{ $data->links() }}
@endif --}}
@endsection
@push('script')
    @include('includes.user.vote')
@endpush
