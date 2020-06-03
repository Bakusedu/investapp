@extends('layouts.app')

@section('content')
<div class="bg-gray-100 pl-3 h-full">
    <h1 class="p-2 font-semibold font-sans text-gray-700 text-2xl">Dashboard</h1>
    <hr class="w-full bg-gray-500">
    <div class="xs:flex-col-reverse flex h-full overflow-x-hidden xs:overflow-y-scroll">
       @if (Auth::user()->isAdmin)
       <div class="xs:flex xs:flex-1 xs:flex-col xs:w-full xs:p-3 w-1/4 pb-20 border-r-2 border-grey xs:content-center xs:overflow-y-visible overflow-y-scroll">
        <div x-data="{ open: false, message: 'boy o boy' }" class="m-2">
            <div class="flex flex-row p-2 xs:h-full xs:w-full bg-white rounded-md shadow-md" x-on:click="open = true">
                <span class="p-2 text-2xl text-gray-500"><i class="fas fa-list-alt"></i></span>
                <div>
                    <h3 class="font-bold text-gray-800">School Event</h3>
                    <p class="text-gray-700">This is a description of school evenys</p>
                </div>
            </div>
          <!--Overlay-->
            <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="open" x-show="open" @click.away="open = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': open }">
                <!--Dialog-->
                <div class="bg-white w-11/12 h-screen md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold" x-text="message">Simple Modal!</p>
                        <div class="cursor-pointer z-50" @click="open = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- content -->
                    <p>Modal content can go here</p>
                    <p>...</p>
                    <p>...</p>
                    <p>...</p>
                    <p>...</p>

                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>
        <div class="flex flex-row p-2 m-2 bg-white rounded-md shadow-md">
            <span class="p-2 text-2xl text-gray-500"><i class="fas fa-list-alt"></i></span>
            <div>
                <h3 class="font-bold text-gray-800">School Event</h3>
                <p class="text-gray-700">This is a description of school evenys</p>
            </div>
        </div>
        <div class="flex flex-row p-2 m-2 bg-white rounded-md shadow-md">
            <span class="p-2 text-2xl text-gray-500"><i class="fas fa-list-alt"></i></span>
            <div>
                <h3 class="font-bold text-gray-800">School Event</h3>
                <p class="text-gray-700">This is a description of school evenys</p>
            </div>
        </div>
        <div class="flex flex-row p-2 m-2 bg-white rounded-md shadow-md">
            <span class="p-2 text-2xl text-gray-500"><i class="fas fa-list-alt"></i></span>
            <div>
                <h3 class="font-bold text-gray-800">School Event</h3>
                <p class="text-gray-700">This is a description of school evenys</p>
            </div>
        </div>
        <div class="flex flex-row p-2 m-2 bg-white rounded-md shadow-md">
            <span class="p-2 text-2xl text-gray-500"><i class="fas fa-list-alt"></i></span>
            <div>
                <h3 class="font-bold text-gray-800">School Event</h3>
                <p class="text-gray-700">This is a description of school evenys</p>
            </div>
        </div>
        <div class="flex flex-row p-2 m-2 bg-white rounded-md shadow-md">
            <span class="p-2 text-2xl text-gray-500"><i class="fas fa-list-alt"></i></span>
            <div>
                <h3 class="font-bold text-gray-800">School Event</h3>
                <p class="text-gray-700">This is a description of school evenys</p>
            </div>
        </div>
    </div>
    <div class="flex-1 flex-row overflow-x-auto xs:overflow-visible xs:w-screen w-3/4 p-3">
        <section class="flex xs:flex-col xs:w-auto w-11/12 xs:items-center justify-evenly p-6">
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
        </section>
        <hr>
        <section class="flex xs:flex-col xs:w-auto w-11/12 xs:items-center justify-evenly p-6">
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
            <div class="bg-white p-3 m-2 shadow-md rounded-md text-center">
                <h3>1</h3>
                <p>Active Courses</p>
            </div>
        </section>
    </div>
       @else
           <h4>Coming Soon</h4>
       @endif
    </div>
</div>

@endsection
