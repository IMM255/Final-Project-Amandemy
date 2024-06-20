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
                                        <h1 class="col">{{$item->title}}</h1>

                                        <form action="{{ route('complaint.delete',['complaint' => $item->id ]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="badge badge-danger rounded-lg py-2 px-5">Hapus</button>
                                        </form>

                                    </div>
                                    <h6>{{ $item->description }}</h6>
                                </div>
                                <div>
                                    <p>{{ $item->location }}, {{ date('M d, Y', strtotime($item->created_at)) }}</p>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="badge badge-danger rounded-pill px-2 py-1">{{$item->urgency}}</span>
                                            <span
                                                class="badge badge-success rounded-pill px-2 py-1">{{ $item->category->name_category }}</span>
                                        </div>
                                        <span
                                            class="badge badge-warning text-white rounded-pill px-2 py-1">{{ $item->status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($item->response)
                                    <div class="row">
                                        <div class="col-md-4  ">
                                            <h5>Ditanggapi:</h5>
                                            <p>{{ $item->response->response_content }}</p>
                                        </div>
                                        <div class="col-md-4  ">
                                            <h5>Tanggal Ditanggapi:</h5>
                                            <p>{{ $item->response->created_at }}</p>
                                        </div>
                                        <div class="col-md-4  ">
                                            <h5>Ditanggapi oleh:</h5>
                                            <p>{{ $item->response->user->name }}</p>
                                        </div>
                                    </div>
                        @endif
                        <div class="row px-3 pt-3 border-top border-dark">
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
        </div>
    </div>
    </div>
@endsection
@push('script')
    @include('includes.user.vote')
@endpush
