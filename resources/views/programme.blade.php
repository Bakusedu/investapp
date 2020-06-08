@extends('layouts.header')
@section('content')
    <div class="flex flex-wrap pt-20 px-6 justify-center">
        @foreach ($programmes as $item)
            <div class="flex-none xs:w-11/12 w-3/12 m-4 text-center">
                <a href="{{route('programme.details', ['id'=>$item->id])}}">
                <div class="shadow-md rounded-md flex items-center justify-center hover:shadow-2xl h-64" style="background-image: url('/files/images?filename={{$item->featured}}'); background-size: cover">
                    <span class="px-6 py-2 rounded-md bg-yellow-600">Join Now</span>
                </div>
                <div class="flex-1 flex-row p-3">
                    <p class="font-bold text-xl mb-2">{{$item->title}}</p>
                    <p class="text-gray-700 text-base">Duration: {{$item->duration}} Months</p>
                </div>
            </a>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col items-center">
        {{$programmes->links()}}
    </div>
@endsection
