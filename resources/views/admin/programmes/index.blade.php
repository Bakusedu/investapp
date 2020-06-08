@extends('layouts.app')

@section('content')

<div class="bg-gray-100 pl-3 px-2 pb-16 h-full overflow-y-scroll">
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
    <div class="flex justify-evenly font-semibold font-mono">
        <h1 class="flex-1 p-2 font-semibold font-mono text-gray-700 text-2xl">Programmes</h1>
        <div x-data="{openForumModal: false}"><button x-on:click="openForumModal = true" class="bg-yellow-600 px-4 py-3 shadow-md rounded-lg text-white">Create Programme</button>
             <!--Overlay-->
             <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="openForumModal" x-show="openForumModal" @click.away="openForumModal = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': openForumModal }">
                <!--Dialog-->
                <div class="bg-white w-1/2 xs:w-full h-auto md:max-w-md mx-auto rounded shadow-lg py-4 mt-10 text-left px-6" x-show="openForumModal" @click.away="openForumModal = false"
                    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Programme</p>
                        <div class="cursor-pointer z-50" @click="openForumModal = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <form action="{{route("store.programme")}}" method="post" enctype="multipart/form-data">
                        @csrf
                         <div class="flex">
                            <div class="flex-col w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme title
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="title" value="{{ old('title') }}" type="text" placeholder="Enter Forum Name">
                            </div>
                            <div class="flex-col w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme Duration
                                  </label>
                                <input required type="number" placeholder="Enter duration in months" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="duration">
                            </div>
                         </div>
                        <label class="block text-gray-700 text-sm font-bold m-2">
                           Detailed Overview of the programme
                        </label>
                        <textarea name="desc" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10">{{ old('desc') }}</textarea>
                        <input type="file" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="featured" required >
                        <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600">Create</button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>

        <div x-data="{ open: false }" class="flex-none px-5">@if($programmes->count()>0)<button  x-on:click="open = true" class="bg-yellow-600 px-4 py-3 shadow-md rounded-lg text-white">Add Programme Tasks</button>@else <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">Warning!</p>
           <p>You have not created any programme yet</p>
        </div> @endif
             <!--Overlay-->
             <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="open" x-show="open" @click.away="open = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': open }">
                <!--Dialog-->
                <div class="bg-white w-1/2 xs:w-full md:max-w-md mx-auto rounded shadow-lg py-4 mt-10 text-left px-6" x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Create Event</p>
                        <div class="cursor-pointer z-50" @click="open = false">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <form action="{{route('save.event')}}" method="post">
                        @csrf
                            <div class="flex">
                                <div class="flex-none w-1/2">
                                    <select required name="programmeId" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        @foreach ($programmes as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="flex-none w-1/2">
                                    <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('title')}}" name="title" type="text" placeholder="Enter  title">
                                    </div>
                                </div>
                                    <div class="flex flex-row w-full">
                                     <div class="flex-1">
                                        <label class="block text-gray-700 text-sm font-bold m-2" > Start Date</label>
                                        <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('startdate')}}" name="startdate" type="datetime-local" placeholder="Start Date">
                                     </div>
                                     <div class="flex-1">

                                        <label class="block text-gray-700 text-sm font-bold m-2">End Date</label>
                                        <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('enddate')}}" name="enddate" type="datetime-local" placeholder="End Date">
                                     </div>
                                    </div>

                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Event Task
                             </label>
                             <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600">Create</button>
                             <textarea name="details" required placeholder="Enter event details here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10">{{old('details')}}</textarea>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>
    </div>
    <hr class="w-full bg-gray-500">
    <table class="table-auto w-full font-mono">
        <thead>
          <tr>
            <th class="border px-4 py-2">Title</th>
            <th class="border px-4 py-2">Description</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
          </tr>
        </thead>
    @if ($programmes->isNotEmpty())
    <tbody>
        @foreach ($programmes as $item)
          <tr>
          <td class="border px-4 py-2">{{$item->title}}</td>
            <td class="border px-4 py-2">{{$item->description}}</td>
            <td class="border px-4 py-2">@if($item->isActive)Active @else Not Active @endif</td>
            <td>
            <a href="{{route('programme.calendar',['id'=>$item->id])}}" class="border-black bg-yellow-700 rounded p-2 hover:bg-yellow-600 text-white m-3"><span class="xs:hidden">View Events Calender</span> <span><i class="fa fa-eye"></i></span></a>
            </td>
          </tr>
        @endforeach
    </tbody>
    @else
        <p class="px-8 text-red-600">No programme created!</p>
    @endif
    </table>
    <div class="p-6 bg-gray-500 text-lg font-semibold">Join Programme Request - <span class="bg-red-500 text-sm rounded-full p-1">({{$pending}}) Pending Requests</span> </div>
    <hr class="w-full bg-gray-500">
    <table class="table-auto w-full font-mono">
        <thead>
          <tr>
            <th class="border px-4 py-2">User Name</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Phone number</th>
            <th class="border px-4 py-2">Programme</th>
            <th class="border px-4 py-2">Status</th>
          </tr>
        </thead>
    @if ($waiting->isNotEmpty())
    <tbody>
        @foreach ($waiting as $item)
          <tr>
          <td class="border px-4 py-2">{{$item->username}}</td>
            <td class="border px-4 py-2">{{$item->email}}</td>
            <td class="border px-4 py-2">{{$item->phone}}</td>
            <td class="border px-4 py-2">{{$item->programme_title}}</td>
            <td class="border px-4 py-2">@if($item->status === 'pending')Awaiting Approval

            <a href="{{route('approve.request', ['id' => $item->id])}}" class="border-black bg-yellow-700 rounded p-2 hover:bg-yellow-600 text-white m-3"><span>Approve</span> <span><i class="fa fa-eye"></i></span></a>
            @else Active @endif</td>
          </tr>
        @endforeach
    </tbody>
    {{$waiting->links()}}
    @else
        <p class="px-8 text-red-600">No pending requests!</p>
    @endif
    </table>
</div>

@endsection
