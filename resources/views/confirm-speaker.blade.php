@extends('layouts.header')
@section('content')
    <div class="flex flex-wrap flex-row xs:flex-col pt-20 px-6 justify-center">
            <div class="flex-1 xs:w-11/12 xs:h-64 mt-4 w-4/12 text-center">
                    <img src="/files/images?filename={{$programme->featured}}" class="h-auto w-11/12" alt="">
            </div>
                <div class="w-8/12 xs:w-full">
                    <p class="font-bold text-2xl text-center mb-2">{{$programme->title}}</p>
                    <div class="flex flex-row flex-wrap">
                        <p class="text-gray-700 text-base"><i class="fa fa-clock"></i> Duration: {{$programme->duration}} days</p>
                        <p class="text-gray-700 text-base"><i class="fa fa-clock"></i> Starts On: {{\Carbon\Carbon::parse($programme->startdate)->toDayDateTimeString()}}</p>
                        <p class="text-gray-700 text-base"><i class="fa fa-clock"></i> Ends On: {{\Carbon\Carbon::parse($programme->enddate)->toDayDateTimeString()}}</p>
                        <p class="text-gray-700 text-base"><i class="fa fa-user"></i> Host: {{$programme->creator->first_name}} {{$programme->creator->last_name}}</p>
                        <p class="text-gray-700 text-base"><i class="fa fa-map-marker"></i>Venue: {{$programme->venue}}</p>
                          @if ($expired)
                             <p class="bg-yellow-500 px-1"> <i class="fa fa-info"></i> Sorry! Programme has ended and Invitation Expired</p>
                          @else
                           @if ($status == 'accepted')
                           <p><i class="fa fa-info"></i><span class="bg-blue-700 cursor-pointer hover:bg-blue-500 text-white p-2 text-sm"> You've accepted this Invite</span></p>
                           @endif
                           @if ($status == 'pending')
                           <p><i class="fa fa-info"></i> <span>Are you <strong>{{$speaker->name}}</strong>?</span> <a href="{{route('accept.speaker', ['id'=>$speaker->id])}}"><span class="bg-blue-700 cursor-pointer hover:bg-blue-500 text-white p-2 text-sm"> Click here to accept this Invite</span></a></p>
                           @else
                            <p><i class="fa fa-info"></i><a href="{{route('decline.speaker', ['id'=>$speaker->id])}}"><span><strong>{{$speaker->name}}</strong></span> <span class="bg-red-700 cursor-pointer hover:bg-red-500 text-white p-2 text-sm">Decline Invite</span></a></p>
                           @endif
                          @endif
                    </div>
                    <p class="text-center font-bold text-2xl">Programme Overview</p>
                    <p class="text-gray-700 text-base"><i class="fa fa-info"></i> {{$programme->overview}}</p>
                    <p class="font-bold text-2xl"> Key Features</p>
                    <ul class="list-disc p-3">
                        @foreach ($features as $item)
                        <li class=" text-lg text-gray-700 text-base">{{$item}}</li>
                        @endforeach
                    </ul>
                </div>
     </div>

@endsection
