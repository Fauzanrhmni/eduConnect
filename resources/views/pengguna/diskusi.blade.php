@extends('layout.app')
  
@section('title', 'Diskusi')
@section('content')

<section class="w-full px-32 py-10 flex justify-center">
    <div class="flex flex-col gap-5 w-[20%] mt-20">
        <div class="flex justify-center items-center pr-5">
            <a href="{{ route("pengguna.forum") }}" class="w-full bg-white flex flex-row items-center gap-3 p-5 rounded-xl shadow-sm">
                <div>
                    <img src="{{ asset("assets/calendar.svg") }}" alt="">
                </div>
                <h2 class="text-gray-600 font-medium text-base">Forum</h2>
            </a>
        </div>

        <div class="flex w-full justify-center items-center pr-5 border-r-blue-400 border-r-[3px] ml-[2.8px] z-20">
            <a href="{{ route("pengguna.diskusi") }}" class="w-full bg-white flex flex-row items-center gap-3 p-5 rounded-xl shadow-sm">
                <div>
                    <img src="{{ asset("assets/message-circle-blue.svg") }}" alt="">
                </div>
                <h2 class="text-blue-400 font-medium text-base">Discuss Group</h2>
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
                <a href="#" onclick="openModal('modalTambah')"  class="flex justify-center items-center w-full bg-white rounded-xl pr-2 py-2 pl-5 shadow-sm">
                    <div class="flex flex-row justify-between items-center w-full">
                        <p class="text-base">Tambah diskusi baru</p>
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
            @if($diskusis->isEmpty())
                <div class="w-full p-8 bg-white flex items-center justify-center rounded-xl shadow-sm mb-32">
                    <h1 class="text-2xl font-semibold m-auto">Belum Ada Diskusi!!</h1>

                </div>
            @else

            @foreach($diskusis as $diskusi)

            <div class="w-full p-8 bg-white flex flex-col rounded-xl shadow-sm">
                <h1 class="text-2xl font-semibold w-full mb-4">{{ $diskusi->judul }}</h1>
                <div class="w-full flex flex-row justify-between items-center">
                    <div class="flex flex-row justify-center items-center">
                        <div class="relative flex items-center justify-center p-3">
                            <div class="flex items-center justify-center overflow-hidden rounded-lg h-16 w-16">
                                <img src="{{ $diskusi->user->image ? asset('storage/' . $diskusi->user->image) : asset('assets/user_regis.svg') }}" alt="" class="object-cover object-top h-full w-full">
                            </div>

                            <div class="absolute flex p-1 items-center justify-center left-0 bottom-0 bg-slate-700 rounded-md">
                                @if ($diskusi->user->role == 1)
                                    <img src="{{ asset('assets/graduation.svg') }}" alt="" class="h-5">
                                @else
                                    <img src="{{ asset('assets/crown.svg') }}" alt="" class="h-5 scale-[.80]">
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <h4 class="text-base font-semibold">{{ $diskusi->user->name }}</h4>
                            <h3 class="text-sm text-gray-400">{{ $diskusi->created_at->diffForHumans() }}</h3>
                        </div>
                    </div>

                    <div class="flex flex-row px-3 py-2 h-fit justify-center text-sm items-center bg-yellow-100 text-yellow-400 border-2 font-medium border-yellow-400 rounded-lg">
                        {{ ucfirst($diskusi->jurusan) }}
                    </div>
                </div>

                <p class="w-full text-sm text-gray-500 mt-5 break-words whitespace-pre-line">
                    {{ $diskusi->deskripsi }}
                </p>

                <div class="flex flex-row items-center mt-5 gap-5">
                    <form action="{{ route('diskusi.favorit', $diskusi->id) }}" method="POST">
                        @csrf
                        @php
                            $isFavorit = auth()->user() && auth()->user()->favoritDiskusis->contains($diskusi->id);
                        @endphp
                        <button type="submit" class="rounded-full {{ $isFavorit ? 'bg-yellow-400 hover:bg-yellow-500 p-3.5' : 'bg-gray-300 hover:bg-gray-400 p-4' }}">
                            <img src="{{ asset('assets/bookmark' . ($isFavorit ? '' : '-gray') . '.svg') }}" alt="">
                        </button>
                    </form>

                    @if ($diskusi->user_id == auth()->id())
                        {{-- Tombol Edit jika user yang membuat diskusi --}}
                        <button onclick="openEditModal({{ $diskusi->id }}, '{{ $diskusi->judul }}', '{{ $diskusi->jurusan }}', '{{ $diskusi->link }}', '{{ $diskusi->deskripsi }}')" class="flex items-center gap-2 p-3 bg-yellow-400 hover:bg-yellow-500 text-white rounded-xl">
                            <img src="{{ asset('assets/edit.svg') }}" alt="Edit" class="h-4">
                            Edit Diskusi
                        </button>

                        <button type="button" onclick="openModal('hapusDiskusiModal{{ $diskusi->id }}')">
                          <i class="fas fa-trash p-4 bg-red-500 hover:bg-red-600 rounded-lg text-white flex items-center justify-center"></i>
                        </button>

                        <!-- Modal Konfirmasi Hapus diskusi -->
                        <div id="hapusDiskusiModal{{ $diskusi->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                          <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
                            <h1 class="text-xl font-semibold text-center text-black">
                              Konfirmasi Hapus diskusi
                            </h1>
                            <p class="text-center text-gray-600 mb-4">
                              Apakah Anda yakin ingin menghapus diskusi <strong>{{ $diskusi->judul }}</strong>?
                            </p>
                            <div class="flex justify-center gap-4">
                              <form action="{{ route('pengguna.diskusi.destroy', $diskusi->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-md">Hapus</button>
                              </form>
                              <button onclick="closeModal('hapusDiskusiModal{{ $diskusi->id }}')" class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-md">Batal</button>
                            </div>
                          </div>
                        </div>

                        {{-- Ganti tombol jika user login adalah pembuat diskusi --}}
                        <div class="flex items-center gap-2 text-gray-500">
                            <img src="{{ asset('assets/check.svg') }}" alt="">
                            <span class="text-sm">You created this diskusi</span>
                        </div>

                    @else

                        {{-- Tampilkan tombol Add Diskusi --}}
                        <a href="{{ $diskusi->link }}" target="_blank" class="flex flex-row items-center justify-center p-3 bg-blue-500 hover:bg-blue-600 gap-2 text-white rounded-xl">
                            <img src="{{ asset('assets/plus-circle.svg') }}" alt="">
                            Join Diskusi
                        </a>

                    @endif
                </div>
            </div>

            @endforeach

            @endif
        </div>
    </div>
</section>


{{-- Modal Tambah Diskusi --}}
<div id="modalTambah" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-2xl py-6 px-10 w-full max-w-lg">
    <h1 class="text-2xl font-semibold text-center text-black">Tambah Grup Diskusi</h1>

    <form class="mt-4 flex flex-col gap-2" action="{{ route('pengguna.diskusi.store') }}" method="POST">
      @csrf
      <label class="text-sm">Judul Diskusi</label>
      <input type="text" name="judul"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Judul Diskusi" required />

      <label class="text-sm">Kategori Diskusi</label>
      <input type="text" name="jurusan"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Kategori Diskusi" required />

      <label class="text-sm">Link</label>
      <input type="text" name="link"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Link" required />

      <label for="dekripsi" class="text-sm">Deskripsi</label>
      <textarea name="deskripsi" class="px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-lg sm:text-sm focus:ring-1" placeholder="Masukan Deskripsi Diskusi" required></textarea>

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
    <h1 class="text-2xl font-semibold text-center text-black">Edit Grup Diskusi</h1>

    <form class="mt-4 flex flex-col gap-2" id="formEditDiskusi" action="" method="POST">
      @csrf
      @method('PUT')

      <input type="hidden" name="id" id="editId">

      <label class="text-sm">Judul Diskusi</label>
      <input type="text" name="judul" id="editJudulDiskusi"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Judul Diskusi" required />

      <label class="text-sm">Kategori Diskusi</label>
      <input type="text" name="jurusan" id="editJurusan"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Kategori Diskusi" required />

      <label class="text-sm">Link</label>
      <input type="text" name="link" id="editLink"
          class="mt-1 px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-full sm:text-sm focus:ring-1"
          placeholder="Link" required />

      <label for="dekripsi" class="text-sm">Deskripsi</label>
      <textarea name="deskripsi" id="editDeskripsi" class="px-5 py-3 border shadow-sm bg-blue-50 placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-lg sm:text-sm focus:ring-1" placeholder="Masukan Deskripsi Diskusi" required></textarea>

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

function openEditModal(id, judul, jurusan, link, deskripsi) {
    document.getElementById('editId').value = id;
    document.getElementById('editJudulDiskusi').value = judul;
    document.getElementById('editJurusan').value = jurusan;
    document.getElementById('editLink').value = link;
    document.getElementById('editDeskripsi').value = deskripsi;

    let formEdit = document.getElementById('formEditDiskusi');
    formEdit.action = `{{ url('pengguna/diskusi/update') }}/${id}`;

    openModal('modalEdit');
  }
</script>


@endsection


