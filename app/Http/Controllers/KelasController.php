<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(): View
    {
        // TODO: Ambil semua data kelas beserta jumlah siswa (withCount 'siswas') dan tampilkan ke view 'kelas.index'
        $kelases = Kelas::withCount('siswas')->get();

        return view('kelas.index', compact('kelases'));
    }

    public function create(): View
    {
        // TODO: Tampilkan form tambah data kelas di view 'kelas.create'
        return view('kelas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: Validasi input (nama_kelas, tingkat, jurusan, tahun_ajaran) lalu simpan data kelas baru
        $validated = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
            'tingkat' => ['required', 'string', 'max:10'],
            'jurusan' => ['required', 'string', 'max:255'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
        ]);

        Kelas::create($validated);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela): View
    {
        // TODO: Tampilkan form edit data kelas di view 'kelas.edit'
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela): RedirectResponse
    {
        // TODO: Validasi input lalu perbarui data kelas
        $validated = $request->validate([
            'nama_kelas' => ['required', 'string', 'max:255'],
            'tingkat' => ['required', 'string', 'max:10'],
            'jurusan' => ['required', 'string', 'max:255'],
            'tahun_ajaran' => ['required', 'string', 'max:20'],
        ]);

        $kela->update($validated);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela): RedirectResponse
    {
        // TODO: Hapus data kelas yang dipilih
        if ($kela->siswas()->exists()) {
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $kela->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
