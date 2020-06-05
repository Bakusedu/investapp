@extends('layouts.users.dashboard')

@section('content')
<div class="bg-gray-300 flex flex-row xs:flex-col py-12 px-6 h-full">
    <div class="flex-none flex flex-col items-center rounded-md w-2/12 p-3 m-3 bg-white">
        <div class="h-24 w-24 rounded-full mt-8 mb-5" style=" background-size:cover; background-image: url('/files/images?filename={{Auth::user()->avatar}}')"></div>
    <h3 class="font-bold"><span>{{Auth::user()->first_name}}</span> <span>{{Auth::user()->last_name}}</span></h3>
        <h3>{{Auth::user()->email}}</h3>
    <div class="mt-4">
        <div
        class="bg-transparent text-white text-sm md:text-base text-center font-semibold py-3 px-6 rounded-t bg-yellow-600"
        type="button"
        >
        Forum
        </div>
    </div>
    </div>
    <div class="flex-1 flex m-3 p-6 w-6/12 font-extrabold text-4xl xs:w-full rounded-lg bg-white justify-center items-center">
        Coming Soon
    </div>
    <div class="flex-none px-3 bg-white m-3 xs:w-full w-3/12 rounded-lg p-5">
        <h3 class="font-bold">Forum Discussions</h3>
    </div>
</div>
@endsection
