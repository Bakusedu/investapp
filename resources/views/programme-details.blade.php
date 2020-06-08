@extends('layouts.header')
@section('content')
    <div class="flex flex-wrap flex-row xs:flex-col pt-20 px-6 justify-center">
            <div class="flex-1 xs:w-11/12 xs:h-64 w-6/12 m-4 text-center">
                    <img src="/files/images?filename={{$programme->featured}}" class="h-full w-full" alt="">
            </div>
                <div class="w-6/12 xs:w-full p-3">
                    <p class="font-bold text-xl mb-2">{{$programme->title}}</p>
                    <p class="text-gray-700 text-base">Duration: {{$programme->duration}} Months</p>
                    <p class="text-gray-700 text-base">{{$programme->description}}</p>
                    @if (Auth::check())
                <a href="{{route('join.request', ['id' => $programme->id])}}"> <div class="px-6 py-4 text-center text-white hover:shadow-xl hover:bg-yellow-700 rounded-md font-bold text-lg w-1/4 bg-yellow-600">Enrol</div></a>
                    @else
                    <p><a href="{{route('login')}}">Login</a> to Enrol</p>
                    @endif
                </div>
     </div>

@endsection
