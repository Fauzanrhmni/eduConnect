<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Mentoring;
use Illuminate\Http\Request;

class MentoringPenggunaController extends Controller
{
    // Menampilkan daftar mentoring
    public function index(Request $request)
    {
        $query = $request->input('search');

        $mentorings = Mentoring::with('favoritOleh')  // Eager loading favoritOleh
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('judul', 'like', "%$query%")
                        ->orWhere('keahlian', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal
        ->get();

        return view('pengguna.mentoring', compact('mentorings'));
    }

    // Menyimpan mentoring baru
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat mentoring!');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'keahlian' => 'required|string|max:255',
            'status' => 'required|in:tersedia,penuh',
            'link' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['is_favorit'] = $data['is_favorit'] ?? 0;
        $data['total_peserta'] = 0; // default awal 0

        Mentoring::create($data);

        return redirect()->back()->with('success', 'Mentoring berhasil ditambahkan!');
    }

    // Mengupdate data mentoring
    public function update(Request $request, Mentoring $mentoring)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'keahlian' => 'required|string|max:255',
            'status' => 'required|in:tersedia,penuh',
            'link' => 'nullable|string',
            'is_favorit' => 'nullable|boolean',
        ]);

        $data['is_favorit'] = $data['is_favorit'] ?? 0;

        $mentoring->update($data);

        return redirect()->back()->with('success', 'Mentoring berhasil diperbarui!');
    }

    // Menghapus data mentoring
    public function destroy(Mentoring $mentoring)
    {
        $mentoring->delete();
        return redirect()->back()->with('success', 'Mentoring berhasil dihapus!');
    }

    public function favorit($mentoringId)
    {
        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();

        // Mencari mentoring berdasarkan ID
        $mentoring = Mentoring::findOrFail($mentoringId);

        // Cek apakah mentoring sudah ada di favorit pengguna
        if ($user->favoritMentorings->contains($mentoring)) {
            // Jika sudah, hapus mentoring dari favorit
            $user->favoritMentorings()->detach($mentoring);
        } else {
            // Jika belum, tambahkan mentoring ke favorit
            $user->favoritMentorings()->attach($mentoring);
        }

        // Redirect kembali ke halaman sebelumnya atau halaman yang diinginkan
        return back();
    }
}
