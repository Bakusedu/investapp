@extends('layouts.app')

@section('content')
<div class="bg-gray-100 pl-3 px-2 h-full overflow-y-scroll">
    @if(Session::has('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
        <p class="font-bold">Success</p>
            <p> {{ Session::get('success') }}</p>
    </div>
    @endif
    @if ($errors->any())
    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
        <p class="font-bold">Errors Caught</p>
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    <div class="flex justify-evenly font-semibold ">
        <h1 class="flex-1 p-2 font-semibold  text-gray-700 text-2xl">Forums</h1>
        <div x-data="{openForumModal: false}"><button x-on:click="openForumModal = true" class="bg-yellow-600 px-4 py-3 shadow-md rounded-lg text-white">Create Forum</button>
             <!--Overlay-->
             <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="openForumModal" x-show="openForumModal" @click.away="openForumModal = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': openForumModal }">
                <!--Dialog-->
                <div class="bg-white w-1/2 xs:w-full h-screen md:max-w-md mx-auto rounded shadow-lg py-4 mt-10 text-left px-6" x-show="openForumModal" @click.away="openForumModal = false"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Forum</p>
                        <div class="cursor-pointer z-50" @click="openForumModal = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <form action="{{route('save.forum')}}" method="post">
                        @csrf
                          <label class="block text-gray-700 text-sm font-bold m-2">
                            Forum title
                          </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" value="{{ old('title') }}" type="text" placeholder="Enter Forum Name">
                        <label class="block text-gray-700 text-sm font-bold m-2">
                           Brief Description
                        </label>
                        <textarea name="desc" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10">{{ old('desc') }}</textarea>
                        <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600">Create</button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>

        <div x-data="{ open: false }" class="flex-none px-5">@if($forums->count()>0)<button  x-on:click="open = true" class="bg-yellow-600 px-4 py-3 shadow-md rounded-lg text-white">Add New Category</button>@else <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Warning!</p>
           <p>You have not created any forum yet</p>
        </div> @endif
             <!--Overlay-->
             <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="open" x-show="open" @click.away="open = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': open }">
                <!--Dialog-->
                <div class="bg-white w-1/2 xs:w-full h-screen md:max-w-md mx-auto rounded shadow-lg py-4 mt-10 text-left px-6" x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Category</p>
                        <div class="cursor-pointer z-50" @click="open = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <form action="{{route('save.category')}}" method="post">
                        @csrf
                        <div class="inline-block relative w-64">
                            <select name="forumId" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                               @foreach ($forums as $item)
                                <option value="{{$item->id}}">{{$item->title}}</option>
                               @endforeach
                            </select>
                          </div>
                          <label class="block text-gray-700 text-sm font-bold m-2">
                            Category title
                          </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('title')}}" name="title" type="text" placeholder="Enter Category title">
                        <label class="block text-gray-700 text-sm font-bold m-2">
                           Brief Description
                        </label>
                        <textarea name="desc" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10">{{old('title')}}</textarea>
                        <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600">Create</button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>
    </div>
    <hr class="w-full bg-gray-500">
    <table class="table-auto w-full ">
        <thead>
          <tr>
            <th class="border px-4 py-2">Title</th>
            <th class="border px-4 py-2">Description</th>
            <th class="border px-4 py-2">Categories</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
          </tr>
        </thead>
    @if ($forums->isNotEmpty())
    <tbody>
        @foreach ($forums as $item)
          <tr>
          <td class="border px-4 py-2">{{$item->title}}</td>
            <td class="border px-4 py-2">{{$item->description}}</td>
            <td class="border px-4 py-2">{{$item->categories->count()}}</td>
            <td class="border px-4 py-2">@if($item->isActive)Active @else Not Active @endif</td>
            <td>
                <a href="#" class="border-black bg-yellow-700 rounded p-2 hover:bg-yellow-600 text-white m-3"><span class="xs:hidden">Deactivate</span> <span><i class="fa fa-eye"></i></span></a>
                    <a href="{{route('topics', ['slug'=>$item->slug])}}" class="border-black bg-red-700 rounded p-2 hover:bg-red-600 text-white"><span class="xs:hidden">Delete</span> <span><i class="fa fa-trash"></i></span></a>
            </td>
          </tr>
        @endforeach
    </tbody>
    @else
        <p class="px-8 text-red-600">No forum created!</p>
    @endif
    </table>
    <h2 class="text-2xl font-semibold  pl-3 p-4 text-gray-700">Forum Categories</h2>
    <hr class="w-full bg-gray-500">
    <table class="table-auto w-full ">
        <thead>
          <tr class="hover:shadow-md">
            <th class="border px-4 py-2">Title</th>
            <th class="border px-4 py-2">Description</th>
            <th class="border px-4 py-2">No of Topics</th>
            <th class="border px-4 py-2">Forum</th>
            <th class="border px-4 py-2">Actions</th>
          </tr>
        </thead>
    @if ($categories->isNotEmpty())
    <tbody>
        @foreach ($categories as $item)
            <tr class="hover:shadow-md">
                <td class="border px-4 py-2">{{$item->title}}</td>
                    <td class="border px-4 py-2">{{$item->description}}</td>
                <td class="border px-4 py-2">{{$item->posts->count()}}</td>
                <td class="border px-4 py-2">{{$item->forum->title}}</td>
                <td> <a href="{{route('topics', ['slug'=>$item->slug])}}" class="border-black bg-yellow-700 rounded p-2 hover:bg-yellow-600 text-white m-3"><span class="xs:hidden">View</span> <span><i class="fa fa-eye"></i></span></a>
                    <a href="{{route('topics', ['slug'=>$item->slug])}}" class="border-black bg-red-700 rounded p-2 hover:bg-red-600 text-white"><span class="xs:hidden">Delete</span> <span><i class="fa fa-trash"></i></span></a>
                </td>
            </tr>
        @endforeach
    </tbody>
    @else
    <p class="px-8 text-red-600">No categories created!</p>
    @endif
    </table>
</div>

@endsection
