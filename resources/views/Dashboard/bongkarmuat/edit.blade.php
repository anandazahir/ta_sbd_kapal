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

        <h5 class="card-title fw-bolder mb-3 h2 text-center">Ubah Data Bongkar Muat</h5>

        <form method="post" action="{{ route('bongkarmuat.update', $data->id_bongkarmuat) }}">
            @csrf
            <div class="mb-3">
                <label for="id_bongkarmuat" class="form-label">ID Bongkar Muat</label>
                <input type="text" class="form-control" id="id_bongkarmuat" name="id_bongkarmuat" value="{{ $data->id_bongkarmuat }}">
            </div>
            <div class="mb-3">
                <label for="nama_client" class="form-label">Nama Client</label>
                <input type="text" class="form-control" id="nama_client" name="nama_client" value="{{ $data->nama_client }}">
            </div>
            <div class="mb-3">
                <label for="tgl_bongkarmuat" class="form-label">Tanggal Bongkar Muat</label>
                <input type="date" class="form-control" id="tgl_bongkarmuat" name="tgl_bongkarmuat" value="{{ $data->tgl_bongkarmuat }}">
            </div>
            <div class="mb-3">
                <label for="harga_bongkarmuat" class="form-label">Harga Bongkar Muat</label>
                <input type="text" class="form-control" id="harga_bongkarmuat" name="harga_bongkarmuat" value="{{ $data->harga_bongkarmuat }}">
            </div>
            <div class="mb-3">
                <label for="lokasi_bongkarmuat" class="form-label">Lokasi Bongkar Muat</label>
                <input type="text" class="form-control" id="lokasi_bongkarmuat" name="lokasi_bongkarmuat" value="{{ $data->lokasi_bongkarmuat }}">
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" value="{{ $data->id_barang }}">
            </div>
            <div class="mb-3">
                <label for="id_kapal" class="form-label">ID Kapal</label>
                <input type="text" class="form-control" id="id_kapal" name="id_kapal" value="{{ $data->id_kapal }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>

@stop