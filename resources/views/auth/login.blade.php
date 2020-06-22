@extends('layouts.header')

@section('content')
<div class=" max-h-full sm:w-1/1 md:w-full lg:w-full h-screen xl:w-full mx-auto px-6 sm:px-12 md:px-12 lg:px-12 xl:px-12 flex mt-24
    md:mt-18 xs:flex-col sm:flex-row md:flex-row lg:flex-row xl:flex-row">
    <div class="xs:w-full sm:w-full w-1/2 items-center">
        <h3 class="font-extrabold text-gray-400">Login</h3>
        <form action="{{route('login')}}" class="shadow-md w-full max-w-lg rounded pt-6 px-6" method="post">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" type="email" placeholder="Email Address">
                  @error('email')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
                  @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 @error('password') border-red-500 @enderror" name="password" required id="password" type="password" placeholder="Password">
                @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            </div>
            <div class="flex items-center border-b border-b-2 border-yellow-500 py-2">
              <button class="flex-shrink-0 bg-yellow-600 hover:bg-yellow-700 border-yellow-600 hover:border-yellow-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                Sign In
              </button>
              <p class="ml-2 text-gray-500">Don't have an account?</p>
            <a class="flex-shrink-0 border-transparent border-4 text-yellow-500 hover:text-yellow-800 text-sm py-1 px-2 rounded" href="{{route('register')}}">
                Register
              </a>
            </div>
          </form>
    </div>
    <div class="xs:hidden sm:hidden w-1/2 px-20 items-center">
    <img src="{{asset('images/undraw_authentication_fsn5.svg')}}" alt="" srcset="">
    </div>
</div>
                                {{-- <input id="email" type="email" class="form-control @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
@endsection
