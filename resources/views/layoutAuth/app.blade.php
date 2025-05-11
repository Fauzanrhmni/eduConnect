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
</head>
<body>

  <nav class="w-full flex flex-row fixed z-50 top-0 left-0 right-0 justify-between items-center bg-white py-2 px-6 lg:px-32 shadow">
    <div class="flex items-center justify-between sm:justify-start w-full gap-16">
      {{-- Logo --}}
      <img src="{{ asset("assets/logo.png") }}" alt="Edurise" class="w-12 lg:w-16">
      {{-- Hamburger (Mobile only) --}}
      <button class="lg:hidden focus:outline-none" id="menu-toggle">
        <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
      {{-- Menu Links (Desktop) --}}
      <div class="hidden lg:flex gap-10 text-sm font-semibold">
        <a href="{{ route("landing_page") }}">HOME</a>
        <a href="{{ route("login") }}" class="{{ request()->routeIs('login') ? 'text-blue-500 hover:text-blue-600 underline' : '' }}">LOGIN PAGE</a>
        <a href="{{ route("register") }}" class="{{ request()->routeIs('register') ? 'text-blue-500 hover:text-blue-600 underline' : '' }}">REGISTER</a>
      </div>
    </div>

    {{-- Mobile Menu (Dropdown) --}}
    <div id="mobile-menu" class="lg:hidden hidden flex flex-col gap-4 absolute top-full left-0 w-full bg-white px-6 py-4 shadow-md z-40 text-sm font-semibold">
      <a href="{{ route("landing_page") }}">HOME</a>
      <a href="{{ route("login") }}" class="{{ request()->routeIs('login') ? 'text-blue-500 hover:text-blue-600 underline' : '' }}">LOGIN PAGE</a>
      <a href="{{ route("register") }}" class="{{ request()->routeIs('register') ? 'text-blue-500 hover:text-blue-600 underline' : '' }}">REGISTER</a>
    </div>
  </nav>

  {{-- Content --}}
    @yield('content')
  {{-- Content --}}

  
  <script>
    const toggleBtn = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    toggleBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>

</body>
</html>