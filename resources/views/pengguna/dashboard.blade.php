<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset("assets/logo.png") }}">
    <title>EduConnect</title>

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
<body class="bg-[#F9F9F9] text-black">
<div class="p-6 max-w-7xl mx-auto">
    <h1 class="text-3xl font-semibold mb-4">Pengguna Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}. Anda adalah pengguna di sistem ini.</p>
    <!-- Konten admin lainnya -->
</div>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
        Logout
    </button>
</form>

</body>
</html>


