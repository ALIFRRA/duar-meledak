<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    public function index(): View
    {
        // TODO: Ambil semua data mata pelajaran dan tampilkan ke view 'mapel.index'
        $mapels = Mapel::all();

        return view('mapel.index', compact('mapels'));
    }

    public function create(): View
    {
        // TODO: Tampilkan form tambah data mata pelajaran di view 'mapel.create'
        return view('mapel.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: Validasi input (kode_mapel, nama_mapel, kkm) lalu simpan data mata pelajaran baru
        $validated = $request->validate([
            'kode_mapel' => ['required', 'string', 'max:255', 'unique:mapels,kode_mapel'],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'kkm' => ['required', 'integer', 'between:0,100'],
        ]);

        Mapel::create($validated);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel): View
    {
        // TODO: Tampilkan form edit data mata pelajaran di view 'mapel.edit'
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel): RedirectResponse
    {
        // TODO: Validasi input lalu perbarui data mata pelajaran
        $validated = $request->validate([
            'kode_mapel' => ['required', 'string', 'max:255', Rule::unique('mapels', 'kode_mapel')->ignore($mapel->id)],
            'nama_mapel' => ['required', 'string', 'max:255'],
            'kkm' => ['required', 'integer', 'between:0,100'],
        ]);

        $mapel->update($validated);

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel): RedirectResponse
    {
        // TODO: Hapus data mata pelajaran yang dipilih
        if ($mapel->nilais()->exists()) {
            return redirect()->route('mapel.index')->with('error', 'Mata pelajaran tidak dapat dihapus karena masih digunakan pada data nilai.');
        }

        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}
