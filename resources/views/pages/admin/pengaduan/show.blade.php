@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan</h1>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h4>Detail Pengaduan</h4>
                        <div class="card-header-action">
                            <a href="{{ route('complaint.index') }}" class="btn btn-warning">
                               <i class="fa fa-undo"></i> Go Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <img class="d-block mx-auto" src="{{ Storage::url($complaint->image) }}" style="border-radius: 10px; width: 500px"><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Nama</th>
                                        <th>:</th>
                                        <th>{{ $complaint->user->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <th>:</th>
                                        <th>{{ $complaint->user->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pengaduan</th>
                                        <th>:</th>
                                        <th>{{ date('d M Y', strtotime($complaint->created_at)) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <th>:</th>
                                        <th>
                                            @switch($complaint->status)
                                            @case('belum_diproses')
                                                @php
                                                    $color = 'primary';
                                                    $status = 'Belum diproses';
                                                @endphp
                                                @break
                                            @case('sedang_diproses')
                                                @php
                                                    $color = 'warning';
                                                    $status = 'Sedang diproses';
                                                @endphp
                                                @break
                                            @case('selesai')
                                                @php
                                                    $color = 'success';
                                                    $status = 'Pengaduan selesai';
                                                @endphp
                                                @break
                                            @case('ditolak')
                                                @php
                                                    $color = 'danger' ;
                                                    $status = 'Pengaduan ditolak'
                                                @endphp
                                                @break
                                        @endswitch
                                        <span class="badge badge-{{ $color }}">
                                            {{ $status }}
                                        </span>
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                {{-- <img src="{{ $pengaduan->image() }}" width="50%" alt=""> --}}
                                <table class="table table-hover">
                                    <tr>
                                        <th>Kategori</th>
                                        <th>:</th>
                                        <th>{{ $complaint->category->name_category }}</th>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th>:</th>
                                        {{-- <th>{{ $complaint->lokasi }}</th> --}}
                                    </tr>
                                    <tr>
                                        <th>Isi pengaduan</th>
                                        <th>:</th>
                                        <th>
                                            {{ $complaint->description }}
                                        </th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @empty($complaint->response)
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Beri Tanggapan</h4>
                            </div>
                            <form action="{{route('response')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">

                                            <div class="form-group">
                                                <label>Tulis Tanggapan*</label>
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                                                <textarea name="response_content" class="@error('response_content') ? is-invalid @enderror"
                                                    rows="10" style="width: 100%" required>{{ old('response_content') }}</textarea>
                                                @error('response_content')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" @checked(old('status')==='proses' ) name="status"
                                                        type="radio" id="exampleRadios1" value="sedang_diproses">
                                                    <label class="form-check-label" for="exampleRadios1">
                                                        Proses
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" @checked(old('status')==='ditolak' ) name="status"
                                                        type="radio" id="exampleRadios2" value="ditolak">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                        Tolak
                                                    </label>
                                                </div>
                                                @error('status')
                                                <div class="invalid-feedback d-inline">
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
                                                <span class="fa fa-pen"></span>
                                                Tanggapi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>Tanggapan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Tanggal Ditanggapi</th>
                                            <th>:</th>
                                            <th>{{ date('d M Y', strtotime($complaint->response->created_at)) }}</th>
                                        </tr>
                                        <tr>
                                            <th>Ditanggapi oleh</th>
                                            <th>:</th>
                                            <th>{{ $complaint->response->user->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>Isi Tanggapan</th>
                                            <th>:</th>
                                            <th>{{ $complaint->response->response_content }}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($complaint->status === 'sedang_diproses')
                            <div class="card-footer">
                                <form action="{{ route('response.finish', $complaint->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Yakin, apakah pengaduan telah selesai')">
                                        <span class="fa fa-check"></span> Proses Selesai
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endempty



            </div>
        </div>
    </section>


@endsection
