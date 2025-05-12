<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Diskusi;
use Illuminate\Http\Request;

class DiskusiPenggunaController extends Controller
{
    // Menampilkan daftar diskusi
    public function index(Request $request)
    {
        $query = $request->input('search');

        $query = $request->input('search');

        $diskusis = Diskusi::with('favoritOleh')  // Eager loading favoritOleh
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('judul', 'like', "%$query%")
                        ->orWhere('jurusan', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal
        ->get();

        return view('pengguna.diskusi', compact('diskusis'));
    }

    // Menyimpan diskusi baru
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat diskusi!');
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|string',

        ]);

        $requestData = $request->all();
        $requestData['user_id'] = auth()->id();
        $requestData['is_favorit'] = $requestData['is_favorit'] ?? 0;

        Diskusi::create($requestData);

        return redirect()->back()->with('success', 'Diskusi berhasil ditambahkan!');
    }

    // Mengupdate diskusi
    public function update(Request $request, Diskusi $diskusi)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'link' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'is_favorit' => 'nullable|boolean',
        ]);

        $data['is_favorit'] = $data['is_favorit'] ?? 0;

        $diskusi->update($data);

        return redirect()->back()->with('success', 'Diskusi berhasil diperbarui!');
    }

    // Menghapus diskusi
    public function destroy(Diskusi $diskusi)
    {
        $diskusi->delete();
        return redirect()->back()->with('success', 'Diskusi berhasil dihapus!');
    }

    public function favorit($diskusiId)
    {
        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();

        // Mencari diskusi berdasarkan ID
        $diskusi = Diskusi::findOrFail($diskusiId);

        // Cek apakah diskusi sudah ada di favorit pengguna
        if ($user->favoritDiskusis->contains($diskusi)) {
            // Jika sudah, hapus diskusi dari favorit
            $user->favoritDiskusis()->detach($diskusi);
        } else {
            // Jika belum, tambahkan diskusi ke favorit
            $user->favoritDiskusis()->attach($diskusi);
        }

        // Redirect kembali ke halaman sebelumnya atau halaman yang diinginkan
        return back();
    }


}
