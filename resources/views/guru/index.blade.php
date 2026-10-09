@extends('layouts.main')

@section('title', 'Data Guru')

@section('content')
    <div class="container-fluid">
        {{-- TODO: Buatlah tampilan tabel data guru (memuat NIP, Nama, Jenis Kelamin, Email, No HP, Alamat, serta tombol Aksi Tambah, Edit, dan Hapus) --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
            <a href="{{ route('guru.create') }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm mr-1"></i> Tambah Guru
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gurus as $index => $guru)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $guru->nip }}</td>
                                    <td>{{ $guru->nama }}</td>
                                    <td>{{ $guru->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $guru->email ?: '-' }}</td>
                                    <td>{{ $guru->no_hp ?: '-' }}</td>
                                    <td>{{ $guru->alamat ?: '-' }}</td>
                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('guru.edit', $guru) }}" class="btn btn-sm btn-warning" title="Edit guru" aria-label="Edit guru">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('guru.destroy', $guru) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data guru ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus guru" aria-label="Hapus guru">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
