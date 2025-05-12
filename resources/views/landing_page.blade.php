@extends('layout.app')
  
@section('title', 'Landing Page')
@section('content')

    {{-- Content --}}
    <section class="bg-blue-950 w-full md:px-32 pt-16 pb-60 md:pb-24 px-8 mt-20 relative">
        <div class="w-full flex flex-col md:flex-row justify-between items-center">
            <div class="flex flex-col md:w-[35rem] md:-mt-14 -mt-10">
                <h1 class="text-white font-semibold text-3xl md:text-5xl md:leading-snug mb-3 md:mb-2">Temukan Komunitas, Bangun Koneksi, <br>Raih Peluang</h1>
                <h2 class="text-white text-base">EduConnect adalah ruang digital bagi mahasiswa dan pencari beasiswa untuk terhubung, belajar, dan berkembang bersama.</h2>
                <a href="#" class="mt-10 md:mt-12 bg-blue-500 hover:bg-blue-600 px-10 text-center py-3 md:py-2 text-base rounded-lg font-bold text-white md:w-fit w-full">Get Started</a>
            </div>
            <img src="{{ asset("assets/model_landing.png") }}" alt="" class="w-[30rem] md:w-[32rem] md:m-0 m-[3rem]">
        </div>

    </section>

    {{-- Div di bawah content --}}
    <div class="w-full px-8 md:px-32 absolute top-[calc(100%-0rem)] md:top-[calc(100%-9rem)] left-0 right-0 z-10">
        <div
            class="flex flex-col md:flex-row justify-between h-full gap-5 md:gap-0 bg-white px-12 py-10 rounded-3xl"
            style="box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);">
            <div class="flex flex-col items-center md:items-start text-center md:text-start">
                <div class="bg-blue-500 rounded-full p-2 w-fit">
                    <img src="{{ asset("assets/user.svg") }}" alt="">
                </div>
                <h1 class="text-2xl mt-4 font-semibold">10K Total Mentor </h1>
                <h2 class="text-sm text-gray-400 mt-2">Satu Langkah Lebih Dekat dengan
                    <span class="hidden sm:inline"><br></span>
                    <span class="inline sm:hidden"> </span>
                    Mentor Impianmu</h2>
            </div>
            <div class="flex flex-col items-center md:items-start">
                <div class="bg-blue-500 rounded-full p-2 w-fit">
                    <img src="{{ asset("assets/message-square.svg") }}" alt="">
                </div>
                <h1 class="text-2xl mt-4 font-semibold">10K Total Mentor </h1>
                <h2 class="text-sm text-gray-400 mt-2">Setiap Forum, Peluang Baru untuk
                    <span class="hidden sm:inline"><br></span>
                    <span class="inline sm:hidden"> </span>
                    Berkembang</h2>
            </div>
            <div class="flex flex-col items-center md:items-start">
                <div class="bg-blue-500 rounded-full p-2 w-fit">
                    <img src="{{ asset("assets/users.svg") }}" alt="">
                </div>
                <h1 class="text-2xl mt-4 font-semibold">10K Total Mentor </h1>
                <h2 class="text-sm text-gray-400 mt-2">Belajar Bareng Komunitas Mahasiswa
                    <span class="hidden sm:inline"><br></span>
                    <span class="inline sm:hidden"> </span>
                    dari Seluruh Indonesia</h2>
            </div>
        </div>
    </div>

    {{-- Join Forum --}}
    <section class="md:w-full px-8 md:px-32 py-10 mt-72 md:mt-32 flex justify-center items-center">
        <div class="flex flex-col md:flex-row justify-between w-full items-center">
            <img src="{{ asset("assets/model-forum.png") }}" alt="" class="rounded-[2rem]" style="box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);">
            <div class="flex flex-col w-full md:w-[35rem] mt-10 md:mt-0">
                <h1 class="font-semibold md:text-5xl md:leading-snug mb-2 text-3xl">Belajar Lebih Seru Saat Kita Terhubung</h1>
                <h2 class="text-gray-400 text-base">Bergabunglah dalam komunitas pembelajar! Diskusi seputar materi pelajaran, tugas, kuliah, hingga tips karier tersedia di Forum EduConnect.</h2>
                <div class="flex flex-col md:flex-row justify-between mt-6 md:gap-0 gap-3">
                    <div class="flex flex-row gap-2 items-center">
                        <img src="{{ asset("assets/check.svg") }}" alt="">
                        <h3 class="text-base text-gray-400">Teman Belajar</h3>
                    </div>
                    <div class="flex flex-row gap-2 items-center">
                        <img src="{{ asset("assets/check.svg") }}" alt="">
                        <h3 class="text-base text-gray-400">Mentor</h3>
                    </div>
                    <div class="flex flex-row gap-2 items-center">
                        <img src="{{ asset("assets/check.svg") }}" alt="">
                        <h3 class="text-base text-gray-400">Pencarian Peluang</h3>
                    </div>
                </div>
                <a href="#" class="mt-12 bg-blue-500 hover:bg-blue-600 px-10 text-center py-3 md:py-2 text-base rounded-lg font-bold text-white w-full md:w-fit">Join Forum</a>
            </div>
        </div>
    </section>

    {{-- Join Diskusi --}}
    <section class="flex flex-col w-full px-8 md:px-32 py-10 mt-14 md:mt-20 items-center">
        <h1 class="font-semibold text-3xl leading-snug mb-2 text-center">
            Cari Jawaban, Bangun Koneksi,
            <span class="hidden sm:inline"><br></span>
            <span class="inline sm:hidden"> </span>
            dan Tumbuh Bersama!
        </h1>

        <h2 class="text-gray-400 text-base text-center">
            Temukan teman belajar, mentor, dan jaringan baru yang siap
            <span class="hidden sm:inline"><br></span>
            <span class="inline sm:hidden"> </span>
            membantu kamu mencapai tujuan pendidikan dan profesi.
        </h2>

        <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-10 mt-8 text-center">
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/minat.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Minat</h1>
                <h2 class="text-base text-gray-400 mt-2">Grup Berdasarkan Minat</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/komunitas.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Komunitas</h1>
                <h2 class="text-base text-gray-400 mt-2">Belajar bareng teman <br> satu tujuan</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/mentor.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Mentor</h1>
                <h2 class="text-base text-gray-400 mt-2">Dipandu oleh alumni <br> dan profesional</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/topik.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Topik</h1>
                <h2 class="text-base text-gray-400 mt-2">Diskusi terstruktur <br> sesuai kebutuhan</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/terjadwal.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Terjadwal</h1>
                <h2 class="text-base text-gray-400 mt-2">Diskusi mingguan <br> atau sesi khusus</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/notifikasi.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Notifikasi</h1>
                <h2 class="text-base text-gray-400 mt-2">Update langsung <br> ke pengguna</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/fleksibel.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Fleksibel</h1>
                <h2 class="text-base text-gray-400 mt-2">Akses mudah <br> dari mana saja</h2>
            </div>
            
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-2xl" style="box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.05);">
                <img src="{{ asset("assets/tujuan.svg") }}" alt="">
                <h1 class="text-xl font-semibold mt-3">Tujuan</h1>
                <h2 class="text-base text-gray-400 mt-2">Capai hasil nyata bersama grup belajar terarah.</h2>
            </div>
        </div>

        <a href="#" class="mt-12 bg-blue-500 hover:bg-blue-600 px-10 text-center py-3 md:py-2 text-base rounded-lg font-bold text-white w-fit">Diskusi Sekarang</a>
    </section>

    {{-- Gabung dengan mentor --}}
    <section class="flex flex-col w-full py-10 mt-20 px-8 md:px-0 items-center">
        <h1 class="font-semibold text-3xl leading-snug mb-2 text-center">Terhubung dengan mentor & teman seperjuangan.</h1>
        <h2 class="text-gray-400 text-base text-center">Bergabung dengan Mentor Berpengalaman dan Komunitas Pembelajar.</h2>

        <div class="md:relative w-full md:h-[500px]">
            <div class="flex flex-col md:absolute md:bottom-0 md:left-0 md:right-0 md:overflow-hidden">
                <div class="overflow-x-hidden md:overflow-x-auto w-full hide-scroll px-0 md:px-32">
                    <div class="flex flex-col space-y-6 md:flex-row md:space-x-6 md:space-y-0 md:w-max">
                        
                        <div class="flex flex-col w-full md:flex-shrink-0 md:w-[23rem]">
                            <img src="{{ asset('assets/mentor1.png') }}" alt="Mentor 1"
                                class="rounded-[2rem] w-full object-cover shadow-md">
                            <h1 class="mt-5 text-center font-semibold text-xl">Rizky Maulana</h1>
                            <h1 class="text-center text-gray-400 text-base">Web Development</h1>
                        </div>
                        <div class="flex flex-col w-full md:flex-shrink-0 md:w-[23rem]">
                            <img src="{{ asset('assets/mentor1.png') }}" alt="Mentor 1"
                                class="rounded-[2rem] w-full object-cover shadow-md">
                            <h1 class="mt-5 text-center font-semibold text-xl">Rizky Maulana</h1>
                            <h1 class="text-center text-gray-400 text-base">Web Development</h1>
                        </div>
                        <div class="flex flex-col w-full md:flex-shrink-0 md:w-[23rem]">
                            <img src="{{ asset('assets/mentor1.png') }}" alt="Mentor 1"
                                class="rounded-[2rem] w-full object-cover shadow-md">
                            <h1 class="mt-5 text-center font-semibold text-xl">Rizky Maulana</h1>
                            <h1 class="text-center text-gray-400 text-base">Web Development</h1>
                        </div>
                        <div class="flex flex-col w-full md:flex-shrink-0 md:w-[23rem]">
                            <img src="{{ asset('assets/mentor1.png') }}" alt="Mentor 1"
                                class="rounded-[2rem] w-full object-cover shadow-md">
                            <h1 class="mt-5 text-center font-semibold text-xl">Rizky Maulana</h1>
                            <h1 class="text-center text-gray-400 text-base">Web Development</h1>
                        </div>
                        <div class="flex flex-col w-full md:flex-shrink-0 md:w-[23rem]">
                            <img src="{{ asset('assets/mentor1.png') }}" alt="Mentor 1"
                                class="rounded-[2rem] w-full object-cover shadow-md">
                            <h1 class="mt-5 text-center font-semibold text-xl">Rizky Maulana</h1>
                            <h1 class="text-center text-gray-400 text-base">Web Development</h1>
                        </div>
                        <div class="flex flex-col w-full md:flex-shrink-0 md:w-[23rem]">
                            <img src="{{ asset('assets/mentor1.png') }}" alt="Mentor 1"
                                class="rounded-[2rem] w-full object-cover shadow-md">
                            <h1 class="mt-5 text-center font-semibold text-xl">Rizky Maulana</h1>
                            <h1 class="text-center text-gray-400 text-base">Web Development</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="#" class="mt-12 bg-blue-500 hover:bg-blue-600 px-10 text-center py-3 md:py-2 text-base rounded-lg font-bold text-white w-fit">Gabung dengan Mentor </a>

    </section>

    @endsection
