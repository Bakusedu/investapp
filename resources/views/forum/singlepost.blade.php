@extends('layouts.forum.header')

@section('content')
<div class="bg-gray-300 flex flex-row xs:flex-col py-12 px-6 h-full">
    <div class="flex-none flex flex-col items-center rounded-md w-2/12 p-3 m-3 bg-white">
        <div class="h-24 w-24 rounded-full mt-8 mb-5" style=" background-size:cover; background-image: url('/files/images?filename={{Auth::user()->avatar}}')"></div>
    <h3 class="font-bold"><span>{{Auth::user()->first_name}}</span> <span>{{Auth::user()->last_name}}</span></h3>
        <h3>{{Auth::user()->email}}</h3>
    <div x-data="{ open: false }" class="mt-4">
        <div
        class="bg-transparent text-white text-sm md:text-base text-center font-semibold py-3 px-6 rounded-t bg-yellow-600"
        x-on:click="open = true"
        type="button"
        >
        Start a new topic
        </div>
        <!--Overlay-->
        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="open" x-show="open" @click.away="open = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': open }">
            <!--Dialog-->
            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">

                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Simple Modal!</p>
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
    </div>
    <div class="flex-1 flex m-3 p-6 w-6/12 xs:w-full rounded-lg bg-white justify-between items-start">
        <div class="flex-1 xs:px-2 xs:w-2/12 xs:m-2 w-1/12">
            <div class="rounded-full h-12 w-12"
            style="background-image: url('/files/images?filename={{$post->user->avatar}}');
            background-size: cover">
            </div>
        </div>
        <div class="flex-none xs:w-10/12 w-11/12">
        <h1 class="text-2xl font-bold">{{$post->title}}</h1>
        <span class="text-gray-500">By </span><span class="font-bold text-blue-400">{{$post->user->first_name}}</span> <span class="text-gray-500">On 23 Dec</span>
            <div class="py-3"><span class="text-gray-500"><i class="fa fa-share-alt"></i> Share</span> <span class=" px-8 text-gray-500"><i class="fa fa-edit"></i> Edit</span></div>
            <hr class="bg-gray-500 mb-6 w-full">
            {!! $post->content !!}
            <hr class="bg-gray-500 my-3 w-full">
            <span class="font-bold">20 Replies</span>
            <div id="comments" class="xs:ml-0 ml-8">
                <div class="flex shadow-md mb-2 rounded-lg">
                    <div class="flex-none p-2">
                        <div class="rounded-full h-12 w-12"
                            style="background-image: url('/files/images?filename={{Auth::user()->avatar}}');
                            background-size: cover">
                        </div>
                    </div>
                    <div class="flex-1 p-2">
                        <span class="text-1xl font-semibold">Antony ABA</span> <span class="text-gray-500">30 minutes ago</span>
                        <p>The difficulty of changing the style of the list bullet lies in the fact that both the bullet
                            and the text are in the same element (the LI).
                            If we could put them in different elements, the style rules might become simpler. I</p>
                    </div>
                </div>
                <div class="flex shadow-md">
                    <div class="flex-none p-2">
                        <div class="rounded-full h-12 w-12"
                            style="background-image: url('/files/images?filename={{Auth::user()->avatar}}');
                            background-size: cover">
                        </div>
                    </div>
                    <div class="flex-1 p-3">
                        <span class="text-1xl font-semibold">Antony ABA</span> <span class="text-gray-500">30 minutes ago</span>
                        <p>The difficulty of changing the style of the list bullet lies in the fact that both the bullet
                            and the text are in the same element (the LI).
                            If we could put them in different elements, the style rules might become simpler. I</p>
                    </div>
                </div>
                <form class="w-full">
                    <div class="flex items-center border-b border-b-2 border-yellow-500 py-8">
                      <textarea class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="comment" aria-label="Comment">Write a comment</textarea>
                      <button class="bg-yellow-500 hover:bg-yellow-700 border-yellow-500 hover:border-yellow-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                        Comment
                      </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex-none px-3 bg-white m-3 xs:w-full w-3/12 rounded-lg p-5">
        <h3 class="font-bold">Other Discussions</h3>
    </div>
</div>
@endsection
