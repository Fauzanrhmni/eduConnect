
    <footer class="flex flex-col justify-center items-center py-5 px-8 md:px-32 mt-32 lg:mt-0 bg-white">
        <div class="flex flex-col md:flex-row justify-between w-full gap-5 md:gap-0">
            <div class="flex flex-col gap-5 mb-5 md:mb-0">
                <div class="flex flex-row gap-2 items-center">
                    <img src="{{ asset("assets/logo.png") }}" alt="Edurise" class="w-12">
                    <h1 class="font-bold text-blue-500 italic">EDU<span class="text-yellow-500">RISE</span></h1>
                </div>

                <p class="text-gray-400 text-sm">
                    Solusi lengkap informasi beasiswa dan <br>
                    edukasi, membantu Anda merencanakan <br>
                    masa depan pendidikan yang gemilang.</p>

                <div class="flex flex-row gap-7">
                    <a href="#">
                        <img src="{{ asset("assets/github.svg") }}" alt="" class="w-6">
                    </a>
                    <a href="#">
                        <img src="{{ asset("assets/linkedin.svg") }}" alt="" class="w-6">
                    </a>
                    <a href="#">
                        <img src="{{ asset("assets/x.svg") }}" alt="" class="w-6">
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <h3 class="font-bold">Contact</h3>
                <div class="flex flex-col gap-2">
                    <h4 class="text-gray-400 hover:text-gray-500 text-sm">Phone: +628553 11</h4>
                    <h4 class="text-gray-400 hover:text-gray-500 text-sm">Email: EduRise@education.co.id</h4>
                    <h4 class="text-gray-400 hover:text-gray-500 text-sm">Jl. Jendral Sudirman 18, Jakarta, Indonesia</h4>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <h3 class="font-bold">Features</h3>
                <div class="flex flex-col gap-2">
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">Scolarship Hub</a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">EduPrep Tools</a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">EduRise Academy</a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">Edu Events</a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">Edu Connect</a>
                </div>
            </div>

            <div class="flex flex-col gap-3">
                <h3 class="font-bold">Product</h3>
                <div class="flex flex-col gap-2">
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">Template CV</a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">Join Community</a>
                    <a href="#" class="text-gray-400 hover:text-gray-500 text-sm">Submit feedback</a>
                </div>
            </div>

        </div>

        <p class="text-gray-400 text-sm mt-10">© {{ date('Y') }} EDURISE. All rights reserved.</p>

    </footer>
