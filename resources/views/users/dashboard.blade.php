@extends('layouts.users.dashboard')

@section('content')
<div class="bg-gray-300 flex flex-row xs:flex-col py-20 xs:px-0 px-6 h-full">
    <div class="flex-none flex xs:w-full flex-col xs:flex-row items-center rounded-md w-2/12 p-3 xs:m-0 m-3 bg-white">
        <div class="h-24 w-24 rounded-full mt-8 mb-5" style=" background-size:cover; background-image: url('/files/images?filename={{Auth::user()->avatar}}')"></div>
        <div class="xs:flex-1 p-4"><h3 class="font-bold"><span>{{Auth::user()->first_name}}</span> <span>{{Auth::user()->last_name}}</span></h3>
            <h3>{{Auth::user()->email}}</h3></div>
        <div class="mt-4">
        <a href="{{route('forum.home')}}"
            class="bg-transparent text-white text-sm md:text-base text-center font-semibold py-3 px-6 rounded-t bg-yellow-600"
            >
            Forum
        </a>
    </div>
    </div>
    <div class="flex-1 xs:m-0 xs:mt-5 m-3 p-6 flex xs:flex-col rounded-lg bg-white">
        <div class="w-2/12 flex xs:flex-none xs:w-full flex-col bg-gray-500">
        <p class=" font-extrabold pb-4 text-2xl text-center">My Programme</p>
        <p class="text-center font-bold">{{$programme->title}}</p>
        <a href="{{route('user.calendar', ['id'=>$programme->id])}}" class="text-lg text-center"><span class=" hover:shadow-2xl hover:bg-yellow-700 shadow-lg p-1 rounded-md bg-yellow-600"> View Calendar <i class="fa fa-eye"></i></span> </a>
        </div>
        <div class="w-10/12 xs:w-full flex-col h-screen bg-white">
            <div class=" p-2 text-center">
                <h1 class="font-extrabold text-xl">Programme Overview</h1>
            </div>
            <p class="px-16 pt-6 text-justify">{!!$programme->description!!}</p>
            <table class="table-auto w-full ">
                <thead>
                    <th class="border py-2">Tasks List</th>
                    <th class="border py-2 ">Start Date</th>
                    <th class="border py-2 ">Due Date</th>
                </thead>
                <tbody>
                @if ($programme->events()->count() > 0)
                @foreach ($programme->events as $item)
                <tr>
                    <td class=" text-black py-2 px-6">
                        {{$item->title}}
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($item->startdate)}}
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($item->enddate)}}
                    </td>
                </tr>
            @endforeach
                @else
                <p> <i class="fa fa-info"></i> No task available for now!</p>
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
