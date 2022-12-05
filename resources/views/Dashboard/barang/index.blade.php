@extends('dashboard.layout')

@section('content')

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h4 class="mt-5 text-center h1 fw-bolder">Data Barang</h4>

        <div class="container d-flex mb-3">
            <a href="{{ route('barang.create') }}" type="button" class="btn btn-success rounded-3 me-auto">Tambah Data</a>
            <form class="d-flex" role="search" method="GET" action="{{ route('barang.search') }}">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        <div class="container mb-3">
            <a href="{{ route('barang.softindex') }}" type="button" class="btn btn-warning rounded-3">Recent Delete</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover mt-2 table-bordered boder-primary rounded text-center shadow p-3 mb-5 rounded">
            <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->id_barang }}</td>
                    <td>{{ $data->nama_barang }}</td>
                    <td>{{ $data->jns_barang }}</td>
                    <td>{{ $data->jmlh_barang }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $data->id_barang) }}" type="button" class="btn btn-outline-warning rounded-3">Ubah</a>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->id_barang }}">
                            Hapus
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="hapusModal{{ $data->id_barang }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('barang.softdelete', $data->id_barang) }}">
                                        @csrf
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus data ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Ya</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@stop