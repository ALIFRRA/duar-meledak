@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah form edit data kelas dengan me-load value data kelas yang akan diperbarui --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Data Kelas</h1>
            <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Kelas</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kelas.update', $kela) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input id="nama_kelas" name="nama_kelas" type="text" class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas', $kela->nama_kelas) }}" required>
                        @error('nama_kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tingkat">Tingkat</label>
                            <input id="tingkat" name="tingkat" type="text" class="form-control @error('tingkat') is-invalid @enderror" value="{{ old('tingkat', $kela->tingkat) }}" maxlength="10" required>
                            @error('tingkat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jurusan">Jurusan</label>
                            <input id="jurusan" name="jurusan" type="text" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan', $kela->jurusan) }}" required>
                            @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input id="tahun_ajaran" name="tahun_ajaran" type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran', $kela->tahun_ajaran) }}" maxlength="20" required>
                        @error('tahun_ajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
