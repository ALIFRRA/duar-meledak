@extends('layouts.main')

@section('title', 'Edit Data Nilai')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah form edit data nilai dengan me-load value data nilai yang akan diperbarui --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Nilai Siswa</h1>
            <a href="{{ route('nilai.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nilai Akademik</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('nilai.update', $nilai) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="siswa_id">Siswa</label>
                            <select id="siswa_id" name="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror" required>
                                <option value="">Pilih siswa</option>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" @selected((string) old('siswa_id', $nilai->siswa_id) === (string) $siswa->id)>{{ $siswa->nis }} - {{ $siswa->nama }}</option>
                                @endforeach
                            </select>
                            @error('siswa_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mapel_id">Mata Pelajaran</label>
                            <select id="mapel_id" name="mapel_id" class="form-control @error('mapel_id') is-invalid @enderror" required>
                                <option value="">Pilih mata pelajaran</option>
                                @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}" @selected((string) old('mapel_id', $nilai->mapel_id) === (string) $mapel->id)>{{ $mapel->kode_mapel }} - {{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('mapel_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nilai_tugas">Nilai Tugas</label>
                            <input id="nilai_tugas" name="nilai_tugas" type="number" class="form-control @error('nilai_tugas') is-invalid @enderror" value="{{ old('nilai_tugas', $nilai->nilai_tugas) }}" min="0" max="100" step="0.01" required>
                            @error('nilai_tugas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nilai_uts">Nilai UTS</label>
                            <input id="nilai_uts" name="nilai_uts" type="number" class="form-control @error('nilai_uts') is-invalid @enderror" value="{{ old('nilai_uts', $nilai->nilai_uts) }}" min="0" max="100" step="0.01" required>
                            @error('nilai_uts')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nilai_uas">Nilai UAS</label>
                            <input id="nilai_uas" name="nilai_uas" type="number" class="form-control @error('nilai_uas') is-invalid @enderror" value="{{ old('nilai_uas', $nilai->nilai_uas) }}" min="0" max="100" step="0.01" required>
                            @error('nilai_uas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
                    <a href="{{ route('nilai.index') }}" class="btn btn-light">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
