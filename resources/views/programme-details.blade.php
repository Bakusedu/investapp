@extends('layouts.header')
@section('content')
    <div class="flex flex-wrap flex-row xs:flex-col pt-20 px-6 justify-center">
            <div class="flex-1 xs:w-11/12 xs:h-64 mt-4 w-4/12 text-center">
                    <img src="/files/images?filename={{$programme->featured}}" class="h-auto w-11/12" alt="">
            </div>
                <div class="w-8/12 xs:w-full">
                    <p class="font-bold text-xl mb-2">{{$programme->title}}</p>
                    <p class="text-gray-700 text-base"><i class="fa fa-clock"></i> Duration: {{$programme->duration}} days</p>
                    <p class="text-gray-700 text-base"><i class="fa fa-info"></i> {{$programme->overview}}</p>
                    <p class="font-bold text-lg"><i class="fa fa-info"></i> Key Features</p>
                    <ul class="p-3">
                        @foreach ($features as $item)
                        <li class="text-lg font-medium">{{$item}}</li>
                        @endforeach
                    </ul>
                    @if (Auth::check())
                        @if($requested == 'true') <p class="mt-6 bg-gray-800 text-white py-2 px-6 w-1/4 rounded-md">Awaiting Confirmation</p> @else <a href="{{route('join.request', ['id' => $programme->id])}}"> <div class="px-6 py-4 text-center text-white hover:shadow-xl hover:bg-yellow-700 rounded-md font-bold text-lg w-1/4 bg-yellow-600">Enroll</div></a> @endif
                    @else
                    <p><a href="{{route('login')}}">Login</a> to Enroll</p>
                    @endif
                </div>
     </div>

@endsection
