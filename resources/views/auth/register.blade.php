@extends('layoutAuth.app')
  
@section('title', 'Register')
@section('content')

  <section class="w-full h-screen px-8 sm:px-12 lg:px-32 md:mt-0 mt-20 flex items-center justify-center">
    <div class="flex flex-col lg:flex-row justify-between items-center w-full bg-[#F9F9F9] rounded-xl overflow-hidden shadow-md scale-100 md:scale-75 m-auto">
      
      {{-- Form Section --}}
      <div class="flex flex-col justify-center items-center w-full lg:w-1/2 p-8 sm:p-12">
        <h1 class="font-bold italic text-2xl sm:text-3xl text-center">
          HELLO THERE, WELCOME TO <span class="text-blue-500">EDU</span><span class="text-yellow-500">RISE</span>
        </h1>
        <p class="text-sm text-gray-400 mt-2 text-center">Lengkapi Data Akun Anda Untuk Melanjutkan</p>
        
        <form method="POST" action="{{ route('register') }}" class="mt-10 w-full px-0 md:px-5">
          @csrf
          {{-- Email --}}
          <div class="mb-4 flex flex-col w-full gap-2">
            <label for="email" class="font-semibold">Email</label>
            <div class="relative">
              <input 
                type="text" 
                name="email" 
                id="email" 
                placeholder="Enter your email"
                class="w-full py-3 px-4 pr-10 border-2 border-gray-400 rounded-2xl focus:border-blue-500 focus:outline-none">
              <img src="{{ asset("assets/mail.svg") }}" class="absolute inset-y-0 right-3 top-3.5 w-5 h-5 pointer-events-none" />
            </div>
          </div>

          {{-- Username --}}
          <div class="mb-4 flex flex-col w-full gap-2">
            <label for="name" class="font-semibold">Username</label>
            <div class="relative">
              <input 
                type="text" 
                name="name" 
                id="name" 
                placeholder="Enter your name"
                class="w-full py-3 px-4 pr-10 border-2 border-gray-400 rounded-2xl focus:border-blue-500 focus:outline-none">
              <img src="{{ asset("assets/user_regis.svg") }}" class="absolute inset-y-0 right-3 top-3.5 w-5 h-5 pointer-events-none" />
            </div>
          </div>

          {{-- Password --}}
          <div class="mb-4 flex flex-col w-full gap-2">
            <label for="password" class="font-semibold">Password/label>
            <div class="relative">
              <input 
                type="password"
                name="password" 
                id="password" 
                placeholder="Enter your password"
                class="w-full py-3 px-4 pr-10 border-2 border-gray-400 rounded-2xl focus:border-blue-500 focus:outline-none">
              <img src="{{ asset("assets/password.svg") }}" class="absolute inset-y-0 right-3 top-3.5 w-5 h-5 pointer-events-none" />
            </div>
          </div>

          {{-- Password --}}
          <div class="mb-4 flex flex-col w-full gap-2">
            <label for="password_confirmation" class="font-semibold">Konfimasi Password</label>
            <div class="relative">
              <input 
                type="password"
                name="password_confirmation" 
                id="password_confirmation" 
                placeholder="Confirm your password"
                class="w-full py-3 px-4 pr-10 border-2 border-gray-400 rounded-2xl focus:border-blue-500 focus:outline-none">
              <img src="{{ asset("assets/password.svg") }}" class="absolute inset-y-0 right-3 top-3.5 w-5 h-5 pointer-events-none" />
            </div>
          </div>

          <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-xl font-semibold hover:bg-blue-600">
            Login
          </button>

          <div class="mt-4 text-center text-base">
            <span>Don't have an account? <a href="{{ route('register') }}" class="text-yellow-500 hover:underline">Sign up here!</a></span>
          </div>

        </form>
      </div>

      {{-- Gambar Model --}}
      <img src="{{ asset("assets/book.png") }}" alt="" class="w-full lg:w-1/2 hidden lg:block">
    </div>
  </section>
  
@endsection
