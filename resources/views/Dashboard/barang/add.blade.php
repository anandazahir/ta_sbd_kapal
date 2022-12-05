@extends('dashboard.layout')

@section('content')

@if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ $error }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endforeach
@endif

<div class="card mt-4 bg-light text-black shadow p-3 mb-5 rounded">
    <div class="card-body">

        <h5 class="card-title fw-bolder mb-3 text-center h2">Tambah Data Barang</h5>

        <form method="post" action="{{ route('barang.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang">
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang">
            </div>
            <div class="mb-3">
                <label for="jns_barang" class="form-label">Jenis Barang</label>
                <input type="text" class="form-control" id="jns_barang" name="jns_barang">
            </div>
            <div class="mb-3">
                <label for="jmlh_barang" class="form-label">Jumlah Barang</label>
                <input type="text" class="form-control" id="jmlh_barang" name="jmlh_barang">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-outline-primary" value="Tambah" />
            </div>
        </form>
    </div>
</div>

@stop