<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    public function index(): View
    {
        // TODO: Ambil semua data nilai beserta relasi siswa.kelas dan mapel, tampilkan ke view 'nilai.index'
        $nilais = Nilai::with(['siswa.kelas', 'mapel'])->get();

        return view('nilai.index', compact('nilais'));
    }

    public function create(): View
    {
        // TODO: Ambil data siswa dan mapel, tampilkan ke view 'nilai.create'
        $siswas = Siswa::orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.create', compact('siswas', 'mapels'));
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: Validasi input (siswa_id, mapel_id, nilai_tugas, nilai_uts, nilai_uas)
        // Hitung nilai akhir = (tugas*0.3) + (uts*0.3) + (uas*0.4)
        // Tentukan keterangan = nilai_akhir >= kkm ? 'Lulus' : 'Tidak Lulus'
        // Simpan ke database
        $validated = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id', Rule::unique('nilais', 'siswa_id')->where('mapel_id', $request->input('mapel_id'))],
            'mapel_id' => ['required', 'exists:mapels,id'],
            'nilai_tugas' => ['required', 'numeric', 'between:0,100'],
            'nilai_uts' => ['required', 'numeric', 'between:0,100'],
            'nilai_uas' => ['required', 'numeric', 'between:0,100'],
        ]);

        $mapel = Mapel::findOrFail($validated['mapel_id']);
        $validated['nilai_akhir'] = round(
            ($validated['nilai_tugas'] * 0.3) +
            ($validated['nilai_uts'] * 0.3) +
            ($validated['nilai_uas'] * 0.4),
            2
        );
        $validated['keterangan'] = $validated['nilai_akhir'] >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        Nilai::create($validated);

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil ditambahkan.');
    }

    public function edit(Nilai $nilai): View
    {
        // TODO: Ambil data nilai, siswa, dan mapel untuk ditampilkan di form edit 'nilai.edit'
        $siswas = Siswa::orderBy('nama')->get();
        $mapels = Mapel::orderBy('nama_mapel')->get();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, Nilai $nilai): RedirectResponse
    {
        // TODO: Validasi input, hitung ulang nilai akhir & keterangan, lalu perbarui data nilai
        $validated = $request->validate([
            'siswa_id' => ['required', 'exists:siswas,id', Rule::unique('nilais', 'siswa_id')->where('mapel_id', $request->input('mapel_id'))->ignore($nilai->id)],
            'mapel_id' => ['required', 'exists:mapels,id'],
            'nilai_tugas' => ['required', 'numeric', 'between:0,100'],
            'nilai_uts' => ['required', 'numeric', 'between:0,100'],
            'nilai_uas' => ['required', 'numeric', 'between:0,100'],
        ]);

        $mapel = Mapel::findOrFail($validated['mapel_id']);
        $validated['nilai_akhir'] = round(
            ($validated['nilai_tugas'] * 0.3) +
            ($validated['nilai_uts'] * 0.3) +
            ($validated['nilai_uas'] * 0.4),
            2
        );
        $validated['keterangan'] = $validated['nilai_akhir'] >= $mapel->kkm ? 'Lulus' : 'Tidak Lulus';

        $nilai->update($validated);

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }

    public function destroy(Nilai $nilai): RedirectResponse
    {
        // TODO: Hapus data nilai yang dipilih
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil dihapus.');
    }
}
