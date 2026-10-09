<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index(): View
    {
        // TODO: Ambil semua data siswa beserta relasi kelas dan tampilkan ke view 'siswa.index'
        $siswas = Siswa::with('kelas')->get();

        return view('siswa.index', compact('siswas'));
    }

    public function create(): View
    {
        // TODO: Ambil data kelas dan tampilkan view 'siswa.create'
        $kelases = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.create', compact('kelases'));
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: Validasi input (nis, nama, jenis_kelamin, alamat, no_hp, kelas_id) lalu simpan data siswa baru
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:siswas,nis'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['nullable', 'string'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ]);

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa): View
    {
        // TODO: Tampilkan detail data siswa beserta relasi kelas dan nilai ke view 'siswa.show'
        $siswa->load(['kelas', 'nilais.mapel']);

        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa): View
    {
        // TODO: Ambil data siswa dan kelas untuk ditampilkan di form edit 'siswa.edit'
        $kelases = Kelas::orderBy('nama_kelas')->get();

        return view('siswa.edit', compact('siswa', 'kelases'));
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        // TODO: Validasi data input lalu perbarui data siswa
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:255', Rule::unique('siswas', 'nis')->ignore($siswa->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat' => ['nullable', 'string'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        // TODO: Hapus data siswa yang dipilih
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
