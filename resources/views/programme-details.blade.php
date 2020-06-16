@extends('layouts.header')
@section('content')
    <div class="flex flex-wrap flex-row xs:flex-col pt-20 pb-10 px-6 justify-center">
            <div class="flex-1 xs:w-full xs:h-64 mt-4 w-4/12 text-center">
                    <img src="/files/images?filename={{$programme->featured}}" class="h-auto w-full" alt="">
            </div>
                <div class="w-8/12 xs:px-0 px-8 xs:w-full">
                    <p class="font-bold text-2xl text-center mb-2">{{$programme->title}}</p>
                    <div class="table xs:text-xs">
                    <div class="flex-none text-center table-row">
                        <p class=" table-cell text-gray-500 text-base xs:text-xs"><i style="font-size: 10px" class="fa fa-clock"></i> Duration</p>
                        <p class="table-cell text-gray-500 text-base xs:text-xs"><i style="font-size: 10px" class="fa fa-clock"></i> Starts On</p>
                        <p class="table-cell text-gray-500 text-base xs:text-xs"><i style="font-size: 10px" class="fa fa-clock"></i> Ends On</p>
                    </div>
                        <div class="table-row text-center ">
                            <p class="table-cell text-gray-500 text-base xs:text-xs">{{\Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::now()->addDays($programme->duration), \Carbon\CarbonInterface::DIFF_ABSOLUTE)}}</p>
                            <p class="table-cell text-gray-500 text-base xs:text-xs"> {{\Carbon\Carbon::parse($programme->startdate)->toDayDateTimeString()}}</p>
                            <p class="table-cell text-gray-500 text-base xs:text-xs"> {{\Carbon\Carbon::parse($programme->enddate)->toDayDateTimeString()}}</p>
                        </div>
                        <div class="flex-none table-row w-full">
                            <p class=" table-cell text-gray-700 text-base font-semibold xs:text-xs"><i style="font-size: 10px" class="fa fa-user"></i> Host: {{$programme->creator->first_name}} {{$programme->creator->last_name}}</p>
                            <p class="table-cell text-gray-700 text-base xs:text-xs"><i style="font-size: 10px" class=" text-red-700 fa fa-map-marker"></i>Venue: {{$programme->venue}}</p>
                            @if ($expired)
                                <p class="table-cell bg-yellow-500 ml-2 px-3"> <i class="fa fa-info"></i> Sorry! Programme has ended and Invitation Expired</p>
                            @else
                            @if (Auth::check())
                            @if($requested == 'true') <p class="table-cell mt-6 bg-gray-800 text-white py-2 px-6 w-1/4 rounded-md">Awaiting Confirmation</p> @else <a href="{{route('join.request', ['id' => $programme->id])}}"> <div class="px-6 py-4 text-center text-white hover:shadow-xl hover:bg-yellow-700 rounded-md font-bold text-lg w-1/4 bg-yellow-600">Enroll</div></a> @endif
                            @else
                            <p class="w-4/12 px-3 ml-3 text-base xs:text-xs table-cell"> <a href="{{route('login')}}" class="text-white bg-yellow-700 rounded p-1 mt-2"> Login</a> to Enroll</p>
                            @endif
                            @endif
                        </div>
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
                    <p class="text-center font-bold xs:text-lg text-2xl">Programme Overview</p>
                    <p class="text-gray-700 text-base"> {{$programme->overview}}</p>
                    <p class="font-bold text-2xl text-lg"> Key Features</p>
                    <ul class="list-disc p-3 text-justify">
                        @foreach ($features as $item)
                        <li class="text-lg xs:text-base text-gray-700 text-base">{{$item}}</li>
                        @endforeach
                    </ul>
                </div>
     </div>

@endsection
