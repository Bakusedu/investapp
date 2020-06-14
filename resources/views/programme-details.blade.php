@extends('layouts.header')
@section('content')
    <div class="flex flex-wrap flex-row xs:flex-col pt-20 pb-10 px-6 justify-center">
            <div class="flex-1 xs:w-11/12 xs:h-64 mt-4 w-4/12 text-center">
                    <img src="/files/images?filename={{$programme->featured}}" class="h-auto w-11/12" alt="">
            </div>
                <div class="w-8/12 xs:w-full">
                    <p class="font-bold text-2xl text-center mb-2">{{$programme->title}}</p>
                    <div class="flex flex-row flex-wrap">
                        <p class="text-gray-500 text-base"><i class="fa fa-clock"></i> Duration: {{$programme->duration}} days</p>
                        <p class="text-gray-500 text-base"><i class="fa fa-clock"></i> Starts On: {{\Carbon\Carbon::parse($programme->startdate)->toDayDateTimeString()}}</p>
                        <p class="text-gray-500 text-base"><i class="fa fa-clock"></i> Ends On: {{\Carbon\Carbon::parse($programme->enddate)->toDayDateTimeString()}}</p>
                        <p class="text-gray-700 text-base font-semibold"><i class="fa fa-user"></i> Host: {{$programme->creator->first_name}} {{$programme->creator->last_name}}</p>
                        <p class="text-gray-700 text-base"><i class=" text-red-700 fa fa-map-marker"></i>Venue: {{$programme->venue}}</p>
                        @if ($expired)
                             <p class="bg-yellow-500 ml-2 px-3"> <i class="fa fa-info"></i> Sorry! Programme has ended and Invitation Expired</p>
                        @else
                        @if (Auth::check())
                        @if($requested == 'true') <p class="mt-6 bg-gray-800 text-white py-2 px-6 w-1/4 rounded-md">Awaiting Confirmation</p> @else <a href="{{route('join.request', ['id' => $programme->id])}}"> <div class="px-6 py-4 text-center text-white hover:shadow-xl hover:bg-yellow-700 rounded-md font-bold text-lg w-1/4 bg-yellow-600">Enroll</div></a> @endif
                        @else
                        <p><a href="{{route('login')}}">Login</a> to Enroll</p>
                        @endif
                        @endif
                    </div>
                    @if ($speakers->count() > 0)
                    <p class="font-bold text-2xl pt-5 text-center mb-2">Speakers</p>
                    <div class="w-full flex xs:flex-col h-auto flex-wrap pt-3">

                       @foreach ($speakers as $item)
                       <div class="flex-1 flex flex-col h-auto p-3 w-auto justify-center items-center shadow-md">
                           <div class="flex-none rounded-full h-24 w-24" style="background-image:url('/files/images?filename={{$item->image}}'); background-size: cover;  background-repeat: no-repeat; background-position: center;"></div>
                           <div class="flex-none text-lg font-bold">{{$item->first_name}} {{$item->last_name}}</div>
                           <div class="flex-none font-bold"><span>{{$item->title}}</span>, {{$item->organization}}</div>
                           <div class="flex-none"><a href="{{$item->facebook}}"><span class="text-blue-800"><i class="fab fa-facebook-square"></i></span></a> <a href="{{$item->twitter}}"><span class="text-blue-600"><i class="fab fa-twitter-square"></i></span></a> <a href="{{$item->linkedIn}}"><span class="text-blue-600"><i class="fab fa-linkedin"></i></span></a></div>
                       </div>
                       @endforeach
                    </div>
                    @endif
                    <p class="text-center font-bold text-2xl">Programme Overview</p>
                    <p class="text-gray-700 text-base"><i class="fa fa-info"></i> {{$programme->overview}}</p>
                    <p class="font-bold text-2xl"> Key Features</p>
                    <ul class="list-disc p-3 text-justify">
                        @foreach ($features as $item)
                        <li class=" text-lg text-gray-700 text-base">{{$item}}</li>
                        @endforeach
                    </ul>
                </div>
     </div>

@endsection
