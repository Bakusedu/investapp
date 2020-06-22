@extends('layouts.app')

@section('content')

<div x-data="page()" class="bg-gray-100 pl-3 px-2 pb-16 h-full overflow-y-scroll">
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
    <div class="flex justify-evenly font-semibold">
        <h1 class="flex-1 p-2 font-semibold text-gray-700 text-2xl">Programmes</h1>
        <div x-cloak x-data="{openForumModal: false}"><button x-on:click="openForumModal = true" class="bg-yellow-600 px-4 py-3 shadow-md rounded-lg text-white">Create Programme</button>
             <!--Overlay-->
             <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="openForumModal" x-show="openForumModal" @click.away="openForumModal = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': openForumModal }">
                <!--Dialog-->
                <div class="bg-white w-9/12 xs:w-full h-auto md:max-w-md mx-auto rounded shadow-lg py-4 mt-10 text-left pt-56 px-6" x-show="openForumModal" @click.away="openForumModal = false"
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
                    <form x-data="programme()" action="{{route("store.programme")}}" method="post" enctype="multipart/form-data">
                        @csrf
                         <div class="flex">
                            <div class="flex-col px-3 w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme title
                                  </label>
                                <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="title" value="{{ old('title') }}" type="text" placeholder="Enter title">
                            </div>
                            <div class="flex-col px-3 w-full">
                                <label class="block text-gray-700 text-sm font-bold m-2">
                                    Programme Duration
                                  </label>
                                <input required type="number" placeholder="Enter duration in days" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="duration">
                            </div>
                         </div>
                         <div class="flex">
                         <div class="flex-col w-full px-3">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Start Date
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="startdate" value="{{ old('startdate') }}" type="datetime-local">
                         </div>
                        <div class="flex-col w-full px-3">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Venue
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="venue" value="{{ old('venue') }}" type="text" placeholder="Enter Venue">
                        </div>
                        <div class="flex-col w-full px-3">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Maximum number of attendees
                              </label>
                            <input required type="number" placeholder="Enter number of attendees" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="attendee">
                        </div>
                        </div>
                        <label>Choose Event Type</label>
                        <label class="switch">
                            <input class="switch-input" x-bind:checked="paid" type="checkbox" value=""/>
                            <span class="switch-label" data-on="Paid" @click="checkbox()" data-off="Free"></span>
                            <span class="switch-handle" @click="checkbox()"></span>
                        </label>
                        <input type="text" x-model:name="type" hidden name="type" id="">
                        <div x-show="paid" class="flex-col w-full px-3">
                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Event Entry Fee
                              </label>
                            <input required type="number" placeholder="Enter Amount per attendee" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="0" name="amount">
                        </div>
                        <div class="flex-col w-full">
                            <label class="block text-gray-700 text-lg font-bold m-2">
                                Five key features of the event you wish to highlight to your target audience
                              </label>
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="highlight[]" value="{{ old('highlight') }}" type="text" placeholder="1.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="highlight[]" value="{{ old('highlight') }}" type="text" placeholder="2.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="highlight[]" value="{{ old('highlight') }}" type="text" placeholder="3.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="highlight[]" value="{{ old('highlight') }}" type="text" placeholder="4.">
                            <input required class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight w-full focus:outline-none focus:shadow-outline" name="highlight[]" value="{{ old('highlight') }}" type="text" placeholder="5.">
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
             <div class="overflow-auto" x-cloak style="background-color: rgba(0,0,0,0.5)" x-show="open" x-show="open" @click.away="open = false" :class="{ 'absolute inset-0 z-10 flex items-center justify-center': open }">
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
                    <form x-data="create()" action="#" method="post">
                        @csrf
                            <div class="flex flex-col">
                                <div class="flex-1 p-3 flex-row">
                                    <select required x-model:name="programmeId" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                       <option value="">Select Programme</option>
                                        @foreach ($programmes as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="flex-1 flex-row">
                                    <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('title')}}" x-model:name="title" type="text" placeholder="Enter  title">
                                    </div>
                                </div>
                                <div class="flex flex-row w-full">
                                    <div class="flex-1">
                                    <label class="block text-gray-700 text-sm font-bold m-2" > Start Date</label>
                                    <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('startdate')}}" x-model:name="startdate" type="datetime-local" placeholder="Start Date">
                                    </div>
                                    <div class="flex-1">

                                    <label class="block text-gray-700 text-sm font-bold m-2">End Date</label>
                                    <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('enddate')}}" x-model:name="enddate" type="datetime-local" placeholder="End Date">
                                    </div>
                                </div>
                            <div>
                                Will you require feedback from users?
                            </div>
                            <label class="switch">
                                <input class="switch-input" x-bind:checked="useFeedback" type="checkbox" value=""/>
                                <span class="switch-label" data-on="Yes" @click="checkbox()" data-off="No"></span>
                                <span class="switch-handle" @click="checkbox()"></span>
                            </label>
                            <div x-show="useFeedback" x-init="true" x-cloak class="attachment">
                                <input type="text" x-model:name="question" placeholder="Write a question that requires feedback" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="">

                                <select x-model:name="feedbackType" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="">
                                    <option value="">Select Feedback type</option>
                                    <option value="text">Text</option>
                                    <option value="video">Video</option>
                                    <option value="document">Document</option>
                                </select>
                            </div>


                            <label class="block text-gray-700 text-sm font-bold m-2">
                                Event Details
                             </label>
                             <textarea x-model:name="details" required placeholder="Enter event details here" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" cols="30" rows="10">{{old('details')}}</textarea>
                             <button @click="createEvent($event)" class="font-semibold px-10 py-3 rounded-t bg-yellow-600">Create</button>
                    </form>
                </div>
                <!--/Dialog -->
            </div><!-- /Overlay -->
        </div>
    </div>
    <hr class="w-full bg-gray-500">
    <table id="prog" class="table-auto w-full">
        <thead>
          <tr>
            <th class="border px-4 py-2">Title</th>
            <th class="border w-24 px-4 py-2">Description</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Actions</th>
          </tr>
        </thead>
    @if ($programmes->isNotEmpty())
    <tbody>
        @foreach ($programmes as $item)
          <tr>
          <td class="border px-4 py-2">{{$item->title}}</td>
            <td class="border px-4 py-2">{{\Illuminate\Support\Str::limit($item->overview, 150, $end='...')}}</td>
            <td class="border px-4 py-2">@if($item->isActive)Active @else <p>Not Active</p> <span>Approve Programme</span> @endif</td>
            <td class="border px-4">
            <a href="{{route('programme.calendar',['id'=>$item->id])}}" class="border-black bg-yellow-700 rounded p-2 hover:bg-yellow-600 text-white m-3"><span class="xs:hidden">View Calender</span> <span><i class="fa fa-eye"></i></span></a>
            </td>
            <td class="border px-4">
              <button @click="handleClick($event, {{$item->id}})" value={{$item->id}} class="border-black bg-red-700 rounded p-2 hover:bg-red-600 text-white m-3"><span class="xs:hidden">Trash</span> <span><i class="fa fa-trash-alt"></i></span></button>
            </td>
          </tr>
        @endforeach
    </tbody>
    @else
        <p class="px-8 text-red-600">No programme created!</p>
    @endif
    {{$programmes->links()}}
    </table>
    <div class="p-6 bg-teal-900 text-white text-lg font-semibold">Join Programme Request - <span class="bg-red-700 text-sm rounded-full p-1 text-white">{{$pending}}</span> Pending Requests </div>
    <hr class="w-full bg-gray-500">
    <table class="table-auto w-full">
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

<script src={{asset("js/jquery.min.js")}}></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
 function page() {
            return {

            handleClick(e, id) {
            // this.$event and this.$dispatch are **not** defined in x-on handler
            this.delete(id, '/delete/programme')

            },

            deleteWaiter(e, id) {
                    // this.$event and this.$dispatch are **not** defined in x-on handler
                this.delete(id, '/delete/waiter')

            },

            delete(id, url){
                var formdata = new FormData();
                formdata.append("id", id);
                var ajax = new XMLHttpRequest();
                ajax.responseType = 'json';
                ajax.open("POST", url);
                ajax.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))// your url will pass to open method
                ajax.send(formdata)
                ajax.onreadystatechange = function() {
                    if (ajax.readyState ===  XMLHttpRequest.DONE) {
                    var status = ajax.status;
                    var response = ajax.response
                    if (status === 0 || (status >= 200 && status < 400)) {
                        toastr.success(response.status);
                        $("#prog").load(location.href+ " #prog");
                        } else {
                        toastr.warning(response.status)
                        }
                    }
                }
            },
        };
    }
function create(){
    return {
        title: '',
        startdate: '',
        useFeedback: false,
        programmeId:'',
        enddate: '',
        question:'',
        feedbackType:'',
        details: '',
        createEvent(e){
            console.log(this.programmeId)
            var feedback =  this.useFeedback ? 1 : 0;
            var formdata = new FormData();
            formdata.append("id", this.programmeId);
            formdata.append('programmeId', this.programmeId);
            formdata.append('startdate', this.startdate);
            formdata.append('title', this.title);
            formdata.append('enddate', this.enddate);
            formdata.append('useFeedback', feedback);

            if (feedback) {
                    formdata.append('question', this.question);
                formdata.append('feedbackType', this.feedbackType);
            }
            formdata.append('details', this.details);
            var ajax = new XMLHttpRequest();
            ajax.responseType = 'json';
            ajax.open("POST", '/api/addevent');
            ajax.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))// your url will pass to open method
            ajax.send(formdata)
            ajax.onreadystatechange = function() {
                if (ajax.readyState ===  XMLHttpRequest.DONE) {
                var status = ajax.status;
                var response = ajax.response
                if (status === 0 || (status >= 200 && status < 400)) {
                    toastr.success(response.status);
                    $("#prog").load(location.href+ " #prog");
                    } else {
                    console.log(response)
                    var errors = Object.values(response.errors);
                    errors.forEach(element => {
                        toastr.warning(element[0])
                    });
                    toastr.warning(response.status)


                    }
                }
            }
            e.preventDefault()
        },
        checkbox(){
        this.useFeedback = !this.useFeedback
        console.log(this.useFeedback)
        }
    }
}

function programme() {
    return {
        type: 'free',
        paid: false,
        checkbox(){
        this.paid = !this.paid,
        this.paid ? this.type = 'paid' : this.type = "free";
        console.log(this.type)
        }
    }
}

</script>
@endsection
