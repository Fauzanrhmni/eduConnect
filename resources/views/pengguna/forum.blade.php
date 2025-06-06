@extends('layout.app')
  
@section('title', 'Forum')
@section('content')

<section class="w-full px-32 py-10 flex justify-center">
    <div class="flex flex-col gap-5 w-[20%] mt-20">
        <div class="flex w-full justify-center items-center pr-5 border-r-blue-400 border-r-[3px] ml-[2.8px] z-20">
            <a href="{{ route("pengguna.forum") }}" class="w-full bg-white flex flex-row items-center gap-3 p-5 rounded-xl shadow-sm">
                <div>
                    <img src="{{ asset("assets/calendar-blue.svg") }}" alt="">
                </div>
                <h2 class="text-blue-400 font-medium text-base">Forum</h2>
            </a>
        </div>

        <div class="flex justify-center items-center pr-5 ml-[2.8px]">
            <a href="{{ route("pengguna.diskusi") }}" class="w-full bg-white flex flex-row items-center gap-3 p-5 rounded-xl shadow-sm">
                <div>
                    <img src="{{ asset("assets/message-circle.svg") }}" alt="">
                </div>
                <h2 class="text-gray-600 font-medium text-base">Discuss Group</h2>
            </a>
        </div>

        <div class="flex justify-center items-center pr-5 ml-[2.8px]">
            <a href="{{ route("pengguna.mentoring") }}" class="w-full bg-white flex flex-row items-center gap-3 p-5 rounded-xl shadow-sm">
                <div>
                    <img src="{{ asset("assets/briefcase.svg") }}" alt="">
                </div>
                <h2 class="text-gray-600 font-medium text-base">Mentoring</h2>
            </a>
        </div>
        
    </div>

    <div class="flex flex-col pl-5 gap-5 w-[80%] border-l-[3px] h-full">
        <div class="mt-24 w-full flex-col justify-center">
            <div class="flex flex-row w-full justify-center items-center gap-5">
                <a href="#" onclick="openModal('modalTambah')" class="flex justify-center items-center w-full bg-white rounded-xl pr-2 py-2 pl-5 shadow-sm">
                    <div class="flex flex-row justify-between items-center w-full">
                        <p class="text-base">Tambah Forum baru</p>
                        <div class="flex items-center justify-center p-3 bg-blue-500 hover:bg-blue-600 rounded-xl h-full">
                            <img src="{{ asset("assets/plus.svg") }}" alt="">
                        </div>
                    </div>
                </a>
                <a href="#" class="flex justify-center items-center bg-white rounded-xl p-2 shadow-sm">
                    <div class="flex items-center justify-center p-3.5 bg-yellow-400 hover:bg-yellow-500 rounded-xl">
                        <img src="{{ asset("assets/bookmark.svg") }}" alt="">
                    </div>
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-5">
            @if($forums->isEmpty())
                <div class="w-full p-8 bg-white flex items-center justify-center rounded-xl shadow-sm mb-32">
                    <h1 class="text-2xl font-semibold m-auto">Belum Ada Forum!!</h1>

                </div>
            @else

            @foreach($forums as $forum)

            <div class="w-full p-8 bg-white flex flex-col rounded-xl shadow-sm">
                <h1 class="text-2xl font-semibold w-full mb-4">{{ $forum->judul }}</h1>
                <div class="w-full flex flex-row justify-between items-center">
                    <div class="flex flex-row justify-center items-center">
                        <div class="relative flex items-center justify-center p-3">
                            <div class="flex items-center justify-center overflow-hidden rounded-lg h-16 w-16">
                                <img src="{{ $forum->user->image ? asset('storage/' . $forum->user->image) : asset('assets/user_regis.svg') }}" alt="" class="object-cover object-top h-full w-full">
                            </div>

                            <div class="absolute flex p-1 items-center justify-center left-0 bottom-0 bg-slate-700 rounded-lg">
                                @if ($forum->user->role == 1)
                                    <img src="{{ asset('assets/graduation.svg') }}" alt="" class="h-5">
                                @else
                                    <img src="{{ asset('assets/crown.svg') }}" alt="" class="h-5 scale-[.80]">
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <h4 class="text-base font-semibold">{{ $forum->user->name }}</h4>
                            <h3 class="text-sm text-gray-400">{{ $forum->created_at->diffForHumans() }}</h3>
                        </div>
                    </div>
                    <div class="flex flex-row px-3 py-2 h-fit justify-center text-sm items-center bg-green-200 text-green-500 border-2 font-medium border-green-500 rounded-lg">
                        {{ ucfirst($forum->kategori_forum) }}
                    </div>
                </div>

                <p class="w-full text-base text-gray-500 mt-5 break-words whitespace-pre-line">
                    {{ $forum->deskripsi }}
                </p>

                <div class="flex flex-row items-center mt-5 gap-5">
                    <form action="{{ route('forum.favorit', $forum->id) }}" method="POST">
                        @csrf
                        @php
                            $isFavorit = auth()->user() && auth()->user()->favoritForums->contains($forum->id);
                        @endphp
                        <button type="submit" class="rounded-full {{ $isFavorit ? 'bg-yellow-400 hover:bg-yellow-500 p-3.5' : 'bg-gray-300 hover:bg-gray-400 p-4' }}">
                            <img src="{{ asset('assets/bookmark' . ($isFavorit ? '' : '-gray') . '.svg') }}" alt="">
                        </button>
                    </form>

                    @if ($forum->user_id == auth()->id())
                        {{-- Tombol Edit jika user yang membuat forum --}}
                        <button onclick="openEditModal({{ $forum->id }}, '{{ $forum->judul }}', '{{ $forum->kategori_forum }}', '{{ $forum->link }}', '{{ $forum->deskripsi }}')" class="flex items-center gap-2 p-3 bg-yellow-400 hover:bg-yellow-500 text-white rounded-xl">
                            <img src="{{ asset('assets/edit.svg') }}" alt="Edit" class="h-4">
                            Edit Forum
                        </button>

                        <button type="button" onclick="openModal('hapusForumModal{{ $forum->id }}')">
                          <i class="fas fa-trash p-4 bg-red-500 hover:bg-red-600 rounded-lg text-white flex items-center justify-center"></i>
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
                              <form action="{{ route('pengguna.forum.destroy', $forum->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md">Hapus</button>
                              </form>
                              <button onclick="closeModal('hapusForumModal{{ $forum->id }}')" class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-md">Batal</button>
                            </div>
                          </div>
                        </div>

                        {{-- Ganti tombol jika user login adalah pembuat forum --}}
                        <div class="flex items-center gap-2 text-gray-500">
                            <img src="{{ asset('assets/check.svg') }}" alt="">
                            <span class="text-sm">You created this forum</span>
                        </div>

                    @else

                        {{-- Tampilkan tombol Add Response --}}
                        <a href="{{ $forum->link }}" target="_blank" class="flex flex-row items-center justify-center p-3 bg-blue-500 hover:bg-blue-600 gap-2 text-white rounded-xl">
                            <img src="{{ asset('assets/plus-circle.svg') }}" alt="">
                            Add Response
                        </a>

                    @endif
                </div>
            </div>

            @endforeach

            @endif
        </div>
    </div>
</section>

{{-- Modal Tambah Forum --}}
<div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-2xl py-6 px-10 w-full max-w-lg">
    <h1 class="text-2xl font-semibold text-center text-black">Tambah Forum</h1>

    <form class="mt-4 flex flex-col gap-2" action="{{ route('pengguna.forum.store') }}" method="POST">
      @csrf
      <label class="text-sm">Judul Forum</label>
      <input type="text" name="judul"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Judul Forum" required />

      <label class="text-sm">Kategori Forum</label>
      <input type="text" name="kategori_forum"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Kategori Forum" required />

      <label class="text-sm">Link</label>
      <input type="text" name="link"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Link" required />

      <label for="dekripsi" class="text-sm">Deskripsi</label>
      <textarea name="deskripsi" class="px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-lg sm:text-sm focus:ring-1" placeholder="Masukan Deskripsi Forum" required></textarea>

      <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-sm px-5 p-3 rounded-lg mt-3 w-full text-center text-white">
          Tambah Diskusi
      </button>
      <button type="button"
          class="px-5 p-3 border-2 text-sm bg-gray-600 hover:bg-gray-700 rounded-lg mt-1 w-full text-center text-white"
          onclick="closeModal('modalTambah')">
          Batal
      </button>
    </form>

  </div>
</div>

{{-- Modal Edit --}}
<div id="modalEdit" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-2xl py-6 px-10 w-full max-w-lg">
    <h1 class="text-2xl font-semibold text-center text-black">Edit Forum</h1>

    <form class="mt-4 flex flex-col gap-2" id="formEditForum" action="" method="POST">
      @csrf
      @method('PUT')

      <input type="hidden" name="id" id="editId">

      <label class="text-sm">Judul Forum</label>
      <input type="text" name="judul" id="editJudulForum"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Judul Forum" required />

      <label class="text-sm">Kategori Forum</label>
      <input type="text" name="kategori_forum" id="editKategoriForum"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Kategori Forum" required />

      <label class="text-sm">Link</label>
      <input type="text" name="link" id="editLink"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Link" required />

      <label for="dekripsi" class="text-sm">Deskripsi</label>
      <textarea name="deskripsi" id="editDeskripsi" class="px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-lg sm:text-sm focus:ring-1" placeholder="Masukan Deskripsi Forum" required></textarea>

      <button type="submit"
          class="bg-blue-500 hover:bg-blue-600 text-sm px-5 p-3 rounded-lg mt-3 w-full text-center text-white">
          Simpan
      </button>
      <button type="button"
          class="px-5 p-3 border-2 text-sm bg-gray-600 hover:bg-gray-700 rounded-lg mt-1 w-full text-center text-white"
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

function openEditModal(id, judul, kategori, link, deskripsi) {
    document.getElementById('editId').value = id;
    document.getElementById('editJudulForum').value = judul;
    document.getElementById('editKategoriForum').value = kategori;
    document.getElementById('editLink').value = link;
    document.getElementById('editDeskripsi').value = deskripsi;

    let formEdit = document.getElementById('formEditForum');
    formEdit.action = `{{ url('pengguna/forum/update') }}/${id}`;

    openModal('modalEdit');
  }
</script>

@endsection


