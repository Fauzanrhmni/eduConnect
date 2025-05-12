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

  {{-- Navbar --}}
    @include('layout.navbar')
  {{-- Navbar --}}

  {{-- Content --}}
    @yield('content')
  {{-- Content --}}

  {{-- Footer --}}
    @include('layout.footer')
  {{-- Footer --}}


  <script>
      const toggleButton = document.getElementById('menu-toggle');
      const menu = document.getElementById('menu');
      
      toggleButton.addEventListener('click', function (e) {
          e.stopPropagation(); // mencegah event click ini merembet ke document
          menu.classList.toggle('hidden');
      });
  
      document.addEventListener('click', function (e) {
          // Jika klik bukan di dalam menu atau tombol toggle, sembunyikan menu
          if (!menu.contains(e.target) && !toggleButton.contains(e.target)) {
              menu.classList.add('hidden');
          }
      });
  </script>

</body>
</html>

