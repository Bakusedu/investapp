@extends('layouts.header')

@section('content')
<div class=" max-h-full sm:w-1/1 md:w-full lg:w-full h-screen xl:w-full mx-auto px-6 sm:px-12 md:px-12 lg:px-12 xl:px-12 flex mt-24
    md:mt-18 xs:flex-col sm:flex-row md:flex-row lg:flex-row xl:flex-row">
    <div class="xs:w-full sm:w-full w-1/2">
        <h3 class="font-extrabold text-gray-500">Complete the form below</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('register')}}" enctype="multipart/form-data" class="shadow-md w-full max-w-lg rounded pt-6 px-6" method="post">
            @csrf
            <div class="flex flex-wrap -mx-3 pb-3">
              <div class="xs:w-full w-1/2 px-3 mb-6 md:mb-0">
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border-gray-200 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="first_name" name="first_name" type="text" placeholder="First Name">
                @error('first_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
              </div>
              <div class="xs:w-full w-1/2 px-3">
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last_name" name="last_name" type="text" placeholder="Last Name">
                @error('last_name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                  <input min="11" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" name="phone" type="number" placeholder="Phone Number">
                  <p class="text-gray-600 text-xs italic">Must be up to 11 digits</p>
                  @error('phone')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
                  @enderror
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" name="email" type="email" placeholder="Email Address">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" name="password" type="password" placeholder="Password">
                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label for="">Profile Image</label>
                    <input type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="avatar" id="avatar">
                </div>
            </div>
            <div class="flex items-center border-b border-b-2 border-yellow-500 py-2">
              <button class="flex-shrink-0 bg-yellow-600 hover:bg-yellow-700 border-yellow-600 hover:border-yellow-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                Sign Up
              </button>
              <p class="ml-2 text-gray-500">Already have an account?</p>
                <a class="flex-shrink-0 border-transparent border-4 text-yellow-500
                hover:text-yellow-800 text-sm py-1 px-2 rounded" href="{{route('login')}}">
               Login
              </a>
            </div>
          </form>
    </div>
    <div class="xs:hidden sm:hidden w-1/2 px-20 items-center">
    <img src="{{asset('images/undraw_resume_folder_2_arse.svg')}}" alt="" srcset="">
    </div>
</div>
@endsection
