{{-- Navbar --}}
    <nav
        class="w-full flex flex-row fixed z-50 top-0 left-0 right-0 justify-center items-center bg-white py-2 px-8 md:px-32"
        style="box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);">
        <div class="flex flex-row items-center justify-between w-full gap-16">
            <img src="{{ asset("assets/logo.png") }}" alt="Edurise" class="w-16">
            
            <div class="md:flex md:flex-row items-center justify-between w-full text-sm font-semibold hidden">
                <a href="#">HOME</a>
                <a href="#">SCHOLARSHIP HUB</a>
                <a href="#">EDUPREP TOOLS</a>
                <a href="#">EDURISE ACADEMY</a>
                <a href="#">EDU EVENT</a>
                <a href="#" class="text-blue-500 hover:text-blue-600 underline">EDU CONNECT</a>
            </div>
            
            @guest
                <a class="bg-blue-500 hover:bg-blue-600 px-5 py-2 text-sm rounded-lg font-bold text-white md:flex hidden" href="{{ route('login') }}">
                    Login
                </a>
            @endguest

            @auth
            <div x-data="{ open: false }" class="relative md:flex hidden items-center">
                <button @click="open = !open" class="focus:outline-none">
                    @if ($user->image)
                        <div class="w-16 h-16 p-1">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil"
                            class="w-full h-full rounded-full border-none shadow-lg object-cover">
                        </div>
                    @else
                        <i class="fas fa-user-circle text-[3.1rem] text-blue-600"></i>
                    @endif
                </button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-[10rem] w-40 bg-white rounded-md shadow-lg z-50">
                    <a href="{{ route('pengguna.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @endauth


            <button id="menu-toggle" class="md:hidden text-gray-700">
                <!-- Hamburger Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="menu" class="lg:hidden hidden flex text-center h-fit flex-col justify-center items-center gap-4 absolute top-full left-0 w-full bg-white px-6 py-3 shadow-md z-40 text-base font-semibold">
            <a href="#">HOME</a>
            <a href="#">SCHOLARSHIP HUB</a>
            <a href="#">EDUPREP TOOLS</a>
            <a href="#">EDURISE ACADEMY</a>
            <a href="#">EDU EVENT</a>
            <a href="#" class="text-blue-500 hover:text-blue-600 underline">EDU CONNECT</a>
            @guest
                <a class="bg-blue-500 hover:bg-blue-600 px-5 py-2 text-sm rounded-lg font-bold text-white flex justify-center items-center w-[10rem]" href="{{ route('login') }}">
                    Login
                </a>
            @endguest

            @auth
                @if ($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Foto Profil"
                    class="w-full rounded-full border-none shadow-lg object-cover">
                @else
                    <i class="fas fa-user-circle text-[3.1rem] text-blue-600"></i>
                @endif
            @endauth

        </div>
    </nav>