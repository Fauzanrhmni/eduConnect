<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // Menampilkan daftar forum
    public function index(Request $request)
    {
        $query = $request->input('search');

        $forums = Forum::when($query, function ($queryBuilder) use ($query) {
                $queryBuilder->where('judul', 'like', "%$query%")
                             ->orWhere('kategori_forum', 'like', "%$query%");
            })
            ->orderBy('created_at', 'asc') // Urutkan berdasarkan tanggal
            ->get();

        return view('admin.forum', compact('forums'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat forum!');
        }

        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_forum' => 'required|string|max:255',
        ]);

        // Menambahkan ID pengguna yang sedang login
        $requestData = $request->all();
        $requestData['user_id'] = auth()->id(); // Mengambil ID pengguna yang sedang login

        // Membuat forum baru
        Forum::create($requestData);

        return redirect()->back()->with('success', 'Forum berhasil ditambahkan!');
    }


    // Mengupdate forum
    public function update(Request $request, Forum $forum)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_forum' => 'required|string|max:255',
            'is_favorit' => 'required|boolean',
        ]);

        $forum->update($data);

        return redirect()->back()->with('success', 'Forum berhasil diperbarui!');
    }

    // Menghapus forum
    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->back()->with('success', 'Forum berhasil dihapus!');
    }
}
