@extends('layouts.main')

@section('title', 'Data Kelas')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah tampilan tabel data kelas (memuat Nama Kelas, Tingkat, Jurusan, Tahun Ajaran, Jumlah Siswa, serta tombol Aksi Tambah, Edit, dan Hapus) --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Kelas</h1>
            <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Tambah Kelas
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Tingkat</th>
                                <th>Jurusan</th>
                                <th>Tahun Ajaran</th>
                                <th>Jumlah Siswa</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelases as $index => $kelas)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kelas->nama_kelas }}</td>
                                    <td>{{ $kelas->tingkat }}</td>
                                    <td>{{ $kelas->jurusan }}</td>
                                    <td>{{ $kelas->tahun_ajaran }}</td>
                                    <td>{{ $kelas->siswas_count }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('kelas.edit', $kelas) }}" class="btn btn-sm btn-warning" title="Edit kelas" aria-label="Edit kelas">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('kelas.destroy', $kelas) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data kelas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus kelas" aria-label="Hapus kelas">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
