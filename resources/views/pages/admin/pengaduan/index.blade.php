@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Pengaduan</h1>
        </div>

        {{-- <x-Admin.Alert/> --}}

        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Filter</h4>
                            <form action="" method="get">
                                <small for="">Pilih Status</small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{-- <small>Pilih Status</small> --}}
                                            <select name="status" class="form-control">
                                                <option value="" {{ Request()->status == '' ? 'selected' : '' }}>Semua</option>
                                                <option value="belum_diproses" {{ Request()->status == 'belum_diproses' ? 'selected' : '' }}>Belum diproses</option>
                                                <option value="sedang_diproses" {{ Request()->status == 'sedang_diproses' ? 'selected' : '' }}>Sedang diproses</option>
                                                <option value="selesai" {{ Request()->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ Request()->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="fa fa-filter"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data Pengaduan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Pengaduan</th>
                                        <th>Nama Pengadu</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengaduans as $pengaduan)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $pengaduan->created_at }}</td>
                                            <td>{{ $pengaduan->user->name }}</td>
                                            <td>{{ $pengaduan->category->name_category }}</td>
                                            <td>
                                                @switch($pengaduan->status)
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

                                            </td>
                                            <td>
                                                <form action="" method="post" id="formDelete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('complaint.show', $pengaduan->id) }}" class="btn btn-sm btn-info"><span class="fa fa-eye"></span> View</a>
                                                    <button data-action="{{ route('complaint.destroy', $pengaduan->id) }}" class="btn btn-sm btn-danger btnDelete"><i class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('script')
        <script>
            $(document).ready( function () {
                $('#table-1').DataTable();
            } );
        </script>
    @endpush

@endsection
