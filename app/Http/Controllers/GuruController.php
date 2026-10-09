<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index(): View
    {
        // TODO: Ambil semua data guru dan tampilkan ke view 'guru.index'
        $gurus = Guru::all();

        return view('guru.index', compact('gurus'));
    }

    public function create(): View
    {
        // TODO: Tampilkan form tambah data guru di view 'guru.create'
        return view('guru.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO: Validasi input (nip, nama, jenis_kelamin, email, no_hp, alamat) lalu simpan data guru baru
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:255', 'unique:gurus,nip'],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email' => ['nullable', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ]);

        Guru::create($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        // TODO: Tampilkan form edit data guru di view 'guru.edit'
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru): RedirectResponse
    {
        // TODO: Validasi input lalu perbarui data guru
        $validated = $request->validate([
            'nip' => ['required', 'string', 'max:255', Rule::unique('gurus', 'nip')->ignore($guru->id)],
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email' => ['nullable', 'email', 'max:255'],
            'no_hp' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ]);

        $guru->update($validated);

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        // TODO: Hapus data guru yang dipilih
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
