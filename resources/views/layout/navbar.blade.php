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
            
            <a class="bg-blue-500 hover:bg-blue-600 px-5 py-2 text-sm rounded-lg font-bold text-white md:flex hidden" href="{{ route('login') }}">
                Login
            </a>

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
            <a class="bg-blue-500 hover:bg-blue-600 px-5 py-2 text-sm rounded-lg font-bold text-white flex justify-center items-center w-[10rem]" href="{{ route('login') }}">
                Login
            </a>
        </div>
    </nav>