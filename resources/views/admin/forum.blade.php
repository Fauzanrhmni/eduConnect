@extends('layouts_admin.app')
  
@section('title', 'Data Forum')
@section('content')

<div class="px-4 md:px-10 mx-auto w-full -m-24">
<div class="flex flex-wrap">
<div class="w-full mb-4 px-4">
    <div
      class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white"
    >
      <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
          <div
            class="relative w-full px-4 max-w-full flex-grow flex-1 flex flex-row gap-2 items-center"
          >
            <h3 class="font-semibold text-lg text-blueGray-700">
              Data Obat
            </h3>
            
            <a href="#" onclick="openModal('modalTambah')" class="px-2 py-1 flex flex-row items-center justify-center text-xs bg-green-500 rounded-md gap-2 text-white hover:bg-green-600">
              <i class="fas fa-plus rounded-lg text-white"></i>
              Tambah Obat
            </a>

          </div>
        </div>
      </div>

        <div class="block w-full overflow-x-auto">
          <!-- Table for displaying forums -->
          <table class="items-center w-full bg-transparent border-collapse">
            <thead>
              <tr>
                <th class="px-6 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  Judul Forum
                </th>
                <th class="px-6 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  Kategori
                </th>
                <th class="px-6 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  Favorit
                </th>
                <th class="px-6 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">
                  Pengguna
                </th>
                <th class="px-6 py-3 text-xs uppercase border-l-0 border-r-0 font-semibold text-left bg-blueGray-50 text-blueGray-500 border-blueGray-100">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @if($forums->isEmpty())
                <tr>
                  <td colspan="4" class="w-full border-t-0 px-6 py-4 text-center text-gray-600">Data Forum Belum Diisi</td>
                </tr>
              @else
                @foreach($forums as $forum)
                  <tr>
                    <td class="border-t-0 px-6 py-4 text-xs whitespace-nowrap font-bold text-blueGray-600">
                      {{ $forum->judul }}
                    </td>
                    <td class="border-t-0 px-6 py-4 text-xs whitespace-nowrap">
                      {{ ucfirst($forum->kategori_forum) }}
                    </td>
                    <td class="border-t-0 px-6 py-4 text-xs whitespace-nowrap">
                      <span class="px-2 py-1 text-xs font-semibold inline-block uppercase rounded-full {{ $forum->is_favorit ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                        {{ $forum->is_favorit ? 'Favorit' : 'Tidak Favorit' }}
                      </span>
                    </td>
                    <td class="border-t-0 px-6 py-4 text-xs whitespace-nowrap">
                      {{ $forum->user->name }}
                    </td>
                    <td class="border-t-0 px-6 py-4 text-xs whitespace-nowrap">
                      <div class="flex gap-2">
                        <button onclick="openEditModal({{ $forum->id }}, '{{ $forum->judul }}', '{{ $forum->kategori_forum }}', '{{ $forum->is_favorit }}')">
                          <i class="fas fa-edit pl-0.5 w-8 h-8 bg-blue-400 hover:bg-blue-500 rounded-lg text-white flex items-center justify-center"></i>
                        </button>
                        <button type="button" onclick="openModal('hapusForumModal{{ $forum->id }}')">
                          <i class="fas fa-trash w-8 h-8 bg-pink-500 hover:bg-pink-600 rounded-lg text-white flex items-center justify-center"></i>
                        </button>

                        <!-- Modal Konfirmasi Hapus Forum -->
                        <div id="hapusForumModal{{ $forum->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                          <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
                            <h1 class="text-xl font-semibold text-center text-black">
                              Konfirmasi Hapus Forum
                            </h1>
                            <p class="text-center text-gray-600 mb-4">
                              Apakah Anda yakin ingin menghapus forum <strong>{{ $forum->judul }}</strong>?
                            </p>
                            <div class="flex justify-center gap-4">
                              <form action="{{ route('admin.forum.destroy', $forum->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md">Hapus</button>
                              </form>
                              <button onclick="closeModal('hapusForumModal{{ $forum->id }}')" class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-md">Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

{{-- Modal Tambah Forum --}}
<div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
    <h1 class="text-xl font-semibold text-center text-black">
      Tambah Forum
    </h1>

    <form class="mt-4 flex flex-col gap-2" action="{{ route('admin.forum.store') }}" method="POST">
      @csrf
      <input type="text" name="judul"
          class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
          placeholder="Judul Forum" required />

      <input type="text" name="kategori_forum"
          class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
          placeholder="Kategori Forum" required />

      <label for="is_favorit" class="text-xs">Favorit</label>
      <select name="is_favorit"
          class="mt-1 px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1">
          <option value="1">Ya</option>
          <option value="0">Tidak</option>
      </select>

      <button type="submit"
          class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-1 w-full text-center text-white">
          Simpan
      </button>
      <button type="button"
          class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold mt-1 w-full text-center text-[#0BB4A6]"
          onclick="closeModal('modalTambah')">
          Batal
      </button>
    </form>

  </div>
</div>

{{-- Modal Edit Forum --}}
<div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
    <h1 class="text-xl font-bold text-center text-[#0BB4A6]">
      Edit Forum
    </h1>

    <form class="mt-4 flex flex-col gap-2" id="formEditForum" action="" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" id="editId">

      <label class="text-xs">Judul Forum</label>
      <input type="text" name="judul" id="editJudulForum"
        class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
        placeholder="Judul Forum" required />

      <label class="text-xs">Kategori Forum</label>
      <input type="text" name="kategori_forum" id="editKategoriForum"
        class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1"
        placeholder="Kategori Forum" required />

      <label for="is_favorit" class="text-xs">Favorit</label>
      <select name="is_favorit" id="editIsFavorit"
        class="px-3 py-3 bg-white border shadow-sm border-slate-300 focus:outline-none focus:border-[#0BB4A6] focus:ring-[#0BB4A6] block w-full rounded-md sm:text-sm focus:ring-1">
        <option value="1">Ya</option>
        <option value="0">Tidak</option>
      </select>

      <button type="submit"
        class="bg-[#0BB4A6] px-5 py-2 rounded-md font-bold mt-1 w-full text-center text-white">
        Simpan
      </button>
      <button type="button"
        class="bg-white px-5 py-2 border-2 border-[#0BB4A6] rounded-md font-bold mt-1 w-full text-center text-[#0BB4A6]"
        onclick="closeModal('modalEdit')">
        Batal
      </button>
    </form>
  </div>
</div>

{{-- Script Modal --}}
<script>
  function openModal(id) {
      document.getElementById(id).classList.remove('hidden');
  }

  function closeModal(id) {
      document.getElementById(id).classList.add('hidden');
  }

  function openEditModal(id, judul, kategori, isFavorit) {
      document.getElementById('editId').value = id;
      document.getElementById('editJudulForum').value = judul;
      document.getElementById('editKategoriForum').value = kategori;
      document.getElementById('editIsFavorit').value = isFavorit;

      let formEdit = document.getElementById('formEditForum');
      formEdit.action = `{{ url('admin/forums/update') }}/${id}`;

      openModal('modalEdit');
  }
</script>

@endsection