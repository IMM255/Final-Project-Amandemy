@extends('layouts.admin')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>

        {{-- <x-Admin.Alert/> --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Data User</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Role</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $data)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->address }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->phone }}</td>
                                            <td>{{ $data->role }}</td>
                                            <td>
                                            @if($data->image)
                                                <img class=" rounded-circle" style="height: 50px" src="{{Storage::url($data->image)}}" alt="">
                                            @else
                                                <img class=" rounded-circle" style="height: 50px" src="{{ asset('frontend/assets/img/nophoto.jpg') }}" alt="">
                                            @endif
                                            </td>
                                            <td>
                                                <form action="{{route('user.destroy',$data->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button  class="btn btn-sm btn-danger btnDelete"><i class="fas fa-trash"></i> Hapus</button>
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
@endsection
@push('script')
<script>
    $(document).ready( function () {
        $('#table-1').DataTable();
    } );
</script>
@endpush
