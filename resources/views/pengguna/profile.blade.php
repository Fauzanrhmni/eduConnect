<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset("assets/logo.png") }}">
  <title>EduConnect - @yield('title', 'Default Title')</title>

  {{-- Link Tailwind CSS CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>

  {{-- My Font --}}
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

      * {
          font-family: 'Poppins', sans-serif;
      }

      .hide-scroll::-webkit-scrollbar {
          display: none;
      }
      .hide-scroll {
          -ms-overflow-style: none;  /* IE & Edge */
          scrollbar-width: none;     /* Firefox */
      }
  </style>

  <script src="https://kit.fontawesome.com/b5684de0c6.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>

</head>
<body class="bg-[#F9F9F9] text-black">

  <section class="w-full flex flex-col justify-center p-8">
    <img src="{{ asset("assets/sampul.png") }}" alt="" class="w-full object-cover">

    <div class="w-full flex flex-row items-end -mt-[6rem] px-20 gap-6 items-start">
      {{-- Container image --}}
      <div class="w-[15rem] h-[15rem] shrink-0">
        <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/mentor.svg') }}" alt="" class="w-full h-full object-cover object-top rounded-full border-4 border-blue-500">
      </div>

      {{-- Info dan tombol --}}
      <div class="flex flex-col md:flex-row justify-between items-start w-full mb-12">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-semibold">
              {{ $user->name }}
            </h1>
            <h2 class="text-base text-gray-600">{{ $user->keahlian_jurusan }}</h2>
        </div>
        <div class="flex flex-row items-center gap-3 mt-4 md:mt-0">
            <a href="#" onclick="openPassword()" class="text-white text-sm flex flex-row items-center justify-center gap-2 py-3 px-5 bg-red-500 hover:bg-red-600 rounded-lg">
              <i class="fas fa-unlock text-white text-sm"></i>
              Ubah Password
            </a>
            <a href="{{ route("pengguna.diskusi") }}" class="py-3 px-5 bg-blue-500 hover:bg-blue-600 text-white text-sm rounded-lg">Kembali</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="py-3 px-5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg">
                  Logout
              </button>
            </form>
        </div>
      </div>
    </div>

    <div class="w-full bg-blue-50 flex flex-col justify-center items-center px-20 py-10 mt-20">
      <div class="flex items-center justify-between sm:justify-start w-full">
        {{-- Logo --}}
        <img src="{{ asset("assets/edurise.png") }}" alt="Edurise" class="w-24">
        {{-- Menu Links (Desktop) --}}
        <div class="hidden lg:flex gap-10 text-base font-semibold ml-[24rem] text-gray-600">
          <a href="{{ route("pengguna.profile") }}" class="{{ request()->routeIs('pengguna.profile') ? 'text-blue-500 hover:text-blue-600 underline' : '' }}">PROFIL</a>
          <h2>TERSIMPAN</h2>
          <h2>KOMUNITAS</h2>
        </div>
      </div>

      <div class="w-full flex flex-col items-center bg-white rounded-xl p-10 mt-10">
        <h2 class="text-2xl font-semibold w-full text-center">Informasi Pribadi</h2>
        <div class="flex flex-col gap-5 w-full justify-start mt-5">
          <div class="flex flex-row gap-5 items-center w-[70%]">
            <h4 class="text-lg w-[50%]">Nama Lengkap :</h4>
            <div class="border-2 border-gray-300 px-3 py-2 w-full">{{ $user->name }}</div>
          </div>
          <div class="flex flex-row gap-5 items-center w-[70%]">
            <h4 class="text-lg w-[50%]">Email :</h4>
            <div class="border-2 border-gray-300 px-3 py-2 w-full">{{ $user->email }}</div>
          </div>
          <div class="flex flex-row gap-5 items-center w-[70%]">
            <h4 class="text-lg w-[50%]">Hak Akses :</h4>
            <div class="border-2 border-gray-300 px-3 py-2 w-full">
              @if ( $user->role  == 1)
                  Mahasiswa
              @else
                  Mentor
              @endif
            </div>
          </div>
          <div class="flex flex-row gap-5 items-center w-[70%]">
            <h4 class="text-lg w-[50%]">Keahlian :</h4>
            <div class="border-2 border-gray-300 px-3 py-2 w-full">{{ $user->keahlian_jurusan }}</div>
          </div>
        </div>

        <a href="#" class="py-3 px-10 bg-blue-500 hover:bg-blue-600 text-white text-base rounded-lg mt-5" onclick="openModal()">Edit</a>

      </div>
    </div>
  </section>

  <div id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
      <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
          <h1 class="text-xl font-bold text-center text-blue-500 uppercase">
              UBAH PROFILE
          </h1>

          <!-- Form di dalam modal -->
          <form class="mt-4 flex flex-col gap-2" action="{{ route('pengguna.profile.update') }}" method="POST"
              enctype="multipart/form-data">
              @csrf
              <input type="text" name="name" value="{{ old('name', $user->name) }}"
                  class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="Nama" required />

              <input type="text" name="keahlian_jurusan" value="{{ old('keahlian_jurusan', $user->keahlian_jurusan) }}"
                  class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="Keahlian" required />

              <label for="image" class="mt-3">Image (1:1 PNG/JPG)</label>
              <input type="file" name="image"
                  class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1" />

              <!-- Tombol Submit dan Batal -->
              <button type="submit"
                  class="bg-blue-500 px-5 py-2 rounded-md font-bold w-full text-center text-white">
                  Submit
              </button>
              <button type="button"
                  class="bg-white px-5 py-2 border-2 border-blue-500 rounded-md font-bold w-full text-center text-blue-500 hover:bg-blue-500 hover:text-white"
                  onclick="closeModal()">
                  Batal
              </button>
          </form>
      </div>
  </div>

  <div id="myPassword" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-[90%] max-w-lg">
        <h1 class="text-xl font-bold text-center text-blue-500 uppercase">
            UBAH PASSWORD
        </h1>

        <!-- Form di dalam modal -->
        <form class="mt-4 flex flex-col gap-2" action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Password saat ini -->
            <div class="relative w-full">
              <input type="password" name="current_password" id="current_password"
                  class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="Password saat ini" />
          
              <!-- Ikon Mata -->
              <span onclick="togglePassword('current_password', 'eyeIconCurrent')" 
                  class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                  <i id="eyeIconCurrent" class="fas fa-eye text-gray-300"></i>
              </span>
            </div>
      
            <!-- Password Baru -->
            <div class="relative w-full">
              <input type="password" name="password" id="password"
                  class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="Password Baru" />
          
              <!-- Ikon Mata -->
              <span onclick="togglePassword('password', 'eyeIconNew')" 
                  class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                  <i id="eyeIconNew" class="fas fa-eye text-gray-300"></i>
              </span>
            </div>
      
            <!-- Ulangi Password -->
            <div class="relative w-full">
              <input type="password" name="password_confirmation" id="password_confirmation"
                  class="px-3 py-3 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-blue-500 block w-full rounded-md sm:text-sm focus:ring-1"
                  placeholder="Ulangi Password" />
          
              <!-- Ikon Mata -->
              <span onclick="togglePassword('password_confirmation', 'eyeIconConfirm')" 
                  class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                  <i id="eyeIconConfirm" class="fas fa-eye text-gray-300"></i>
              </span>
            </div>
      
            <!-- Script untuk Toggle Password -->
            <script>
              // Fungsi untuk Toggle Password
              function togglePassword(inputId, iconId) {
                let input = document.getElementById(inputId);
                let icon = document.getElementById(iconId);
            
                if (input.type === "password") {
                    input.type = "text"; // Menampilkan password
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash"); // Ganti ikon mata tertutup
                } else {
                    input.type = "password"; // Menyembunyikan password
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye"); // Ganti ikon mata terbuka
                }
              }
            </script>

            <!-- Tampilkan pesan error jika ada -->
            @if ($errors->any())
            <div class="mt-2 text-red-600">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <!-- Tombol Submit dan Batal -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 px-5 py-2 rounded-md font-bold w-full text-center text-white">
                Submit
            </button>
            <button type="button"
                class="bg-white px-5 py-2 border-2 border-blue-500 hover:text-white rounded-md font-bold w-full text-center text-blue-500 hover:bg-blue-500"
                onclick="closePassword()">
                Batal
            </button>
        </form>
    </div>
  </div>

      <script>
        // Fungsi untuk membuka modal
        function openModal() {
            document.getElementById("myModal").classList.remove("hidden");
        }
        
        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById("myModal").classList.add("hidden");
        }
        
        // Menutup modal jika klik di luar konten modal
        window.onclick = function(event) {
            const modal = document.getElementById("myModal");
            if (event.target === modal) {
                closeModal();
            }
        };
        
        // Modal PAssword
        function openPassword() {
            document.getElementById("myPassword").classList.remove("hidden");
        }
        
        // Fungsi untuk menutup Password
        function closePassword() {
            document.getElementById("myPassword").classList.add("hidden");
        }
        
        // Menutup Password jika klik di luar konten Password
        window.onclick = function(event) {
            const password = document.getElementById("myPassword");
            if (event.target === password) {
                closePassword();
            }
        };
      </script>

</body>
</html>
