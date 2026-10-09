@extends('layouts.main')

@section('title', 'Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah tampilan tabel data mata pelajaran (memuat Kode Mapel, Nama Mapel, KKM, serta tombol Aksi Tambah, Edit, dan Hapus) --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Mata Pelajaran</h1>
            <a href="{{ route('mapel.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Tambah Mata Pelajaran
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Mata Pelajaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Kode Mapel</th>
                                <th>Nama Mapel</th>
                                <th>KKM</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mapels as $index => $mapel)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mapel->kode_mapel }}</td>
                                    <td>{{ $mapel->nama_mapel }}</td>
                                    <td><span class="badge badge-info">{{ $mapel->kkm }}</span></td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('mapel.edit', $mapel) }}" class="btn btn-sm btn-warning" title="Edit mata pelajaran" aria-label="Edit mata pelajaran">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('mapel.destroy', $mapel) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus mata pelajaran" aria-label="Hapus mata pelajaran">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada data mata pelajaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
