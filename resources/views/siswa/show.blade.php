@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah tampilan detail profil siswa beserta riwayat nilai mata pelajaran --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Siswa</h1>
            <div>
                <a href="{{ route('siswa.edit', $siswa) }}" class="btn btn-sm btn-warning shadow-sm">
                    <i class="fas fa-edit fa-sm mr-1"></i> Edit Siswa
                </a>
                <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profil {{ $siswa->nama }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3"><strong>NIS</strong><div>{{ $siswa->nis }}</div></div>
                    <div class="col-md-6 mb-3"><strong>Nama</strong><div>{{ $siswa->nama }}</div></div>
                    <div class="col-md-6 mb-3"><strong>Kelas</strong><div>{{ $siswa->kelas->nama_kelas ?? '-' }}</div></div>
                    <div class="col-md-6 mb-3"><strong>Jenis Kelamin</strong><div>{{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div></div>
                    <div class="col-md-6 mb-3"><strong>No. HP</strong><div>{{ $siswa->no_hp ?: '-' }}</div></div>
                    <div class="col-md-6 mb-3"><strong>Alamat</strong><div>{{ $siswa->alamat ?: '-' }}</div></div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Nilai</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai Tugas</th>
                                <th>Nilai UTS</th>
                                <th>Nilai UAS</th>
                                <th>Nilai Akhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa->nilais as $nilai)
                                <tr>
                                    <td>{{ $nilai->mapel->nama_mapel ?? '-' }}</td>
                                    <td>{{ $nilai->nilai_tugas }}</td>
                                    <td>{{ $nilai->nilai_uts }}</td>
                                    <td>{{ $nilai->nilai_uas }}</td>
                                    <td>{{ $nilai->nilai_akhir }}</td>
                                    <td>{{ $nilai->keterangan ?: '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada riwayat nilai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
