@extends('layouts.main')

@section('title', 'Edit Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah form edit data mata pelajaran dengan me-load value data mapel yang akan diperbarui --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Mata Pelajaran</h1>
            <a href="{{ route('mapel.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('mapel.update', $mapel) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input id="kode_mapel" name="kode_mapel" type="text" class="form-control @error('kode_mapel') is-invalid @enderror" value="{{ old('kode_mapel', $mapel->kode_mapel) }}" required>
                        @error('kode_mapel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_mapel">Nama Mata Pelajaran</label>
                        <input id="nama_mapel" name="nama_mapel" type="text" class="form-control @error('nama_mapel') is-invalid @enderror" value="{{ old('nama_mapel', $mapel->nama_mapel) }}" required>
                        @error('nama_mapel')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label for="kkm">KKM</label>
                        <input id="kkm" name="kkm" type="number" class="form-control @error('kkm') is-invalid @enderror" value="{{ old('kkm', $mapel->kkm) }}" min="0" max="100" required>
                        @error('kkm')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                    <a href="{{ route('mapel.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
