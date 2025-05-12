<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\FavoritForum;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumPenggunaController extends Controller
{
    // Menampilkan daftar forum
    public function index(Request $request)
    {
        $query = $request->input('search');

        $forums = Forum::with('favoritOleh')  // Eager loading favoritOleh
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('judul', 'like', "%$query%")
                        ->orWhere('kategori_forum', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal
        ->get();

        return view('pengguna.forum', compact('forums'));
    }

    // Menyimpan forum baru
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat forum!');
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_forum' => 'required|string|max:255',
            'link' => 'nullable|string',
            'deskripsi' => 'nullable|string', // Validasi deskripsi
        ]);

        // Menambahkan ID pengguna yang sedang login dan nilai default untuk is_favorit
        $requestData = $request->all();
        $requestData['user_id'] = auth()->id(); // Mengambil ID pengguna yang sedang login
        $requestData['is_favorit'] = $requestData['is_favorit'] ?? 0; // Default nilai is_favorit = 0

        // Membuat forum baru
        Forum::create($requestData);

        return redirect()->back()->with('success', 'Forum berhasil ditambahkan!');
    }

    // Mengupdate forum
    public function update(Request $request, Forum $forum)
    {
        // Validasi input dan memastikan nilai is_favorit yang benar
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_forum' => 'required|string|max:255',
            'is_favorit' => 'nullable|boolean', // is_favorit bisa null atau boolean
            'link' => 'nullable|string',
            'deskripsi' => 'nullable|string', // Validasi deskripsi
        ]);

        // Jika is_favorit tidak ada di inputan, default ke 0
        $data['is_favorit'] = $data['is_favorit'] ?? 0;

        // Update forum dengan data baru
        $forum->update($data);

        return redirect()->back()->with('success', 'Forum berhasil diperbarui!');
    }


    // Menghapus forum
    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->back()->with('success', 'Forum berhasil dihapus!');
    }

    public function favorit($forumId)
    {
        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();

        // Mencari forum berdasarkan ID
        $forum = Forum::findOrFail($forumId);

        // Cek apakah forum sudah ada di favorit pengguna
        if ($user->favoritForums->contains($forum)) {
            // Jika sudah, hapus forum dari favorit
            $user->favoritForums()->detach($forum);
        } else {
            // Jika belum, tambahkan forum ke favorit
            $user->favoritForums()->attach($forum);
        }

        // Redirect kembali ke halaman sebelumnya atau halaman yang diinginkan
        return back();
    }




}
