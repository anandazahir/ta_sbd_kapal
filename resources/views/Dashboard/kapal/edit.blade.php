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

        <h5 class="card-title fw-bolder mb-3 h2 text-center">Ubah Data Kapal</h5>

        <form method="post" action="{{ route('kapal.update', $data->id_kapal) }}">
            @csrf
            <div class="mb-3">
                <label for="id_kapal" class="form-label">ID Kapal</label>
                <input type="text" class="form-control" id="id_kapal" name="id_kapal" value="{{ $data->id_kapal }}">
            </div>
            <div class="mb-3">
                <label for="nama_kapal" class="form-label">Nama Kapal</label>
                <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" value="{{ $data->nama_kapal }}">
            </div>
            <div class="mb-3">
                <label for="jns_kapal" class="form-label">Jenis Kapal</label>
                <input type="text" class="form-control" id="jns_kapal" name="jns_kapal" value="{{ $data->jns_kapal }}">
            </div>
            <div class="mb-3">
                <label for="tahun_kapal" class="form-label">Tahun Kapal</label>
                <input type="text" class="form-control" id="tahun_kapal" name="tahun_kapal" value="{{ $data->tahun_kapal }}">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Ubah" />
            </div>
        </form>
    </div>
</div>

@stop