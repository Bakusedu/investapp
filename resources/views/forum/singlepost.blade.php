@extends('layouts.users.dashboard')
@section('header')

<div class="relative h-64 bg-yellow-100">
    <div class="h-48 inset-x-0 bottom-0 px-8 absolute bg-fixed" style="top: 70px; background-image: url('{{asset('images/forum.jpg')}}'); background-size: cover;">
        <div class="py-6 text-white">
            <h2 class="text-4xl">
                Join a forum today
            </h2>
            <h6 class="text-lg">
                participate in any forum that interests you, share your idea with others
            </h6>
        </div>
    </div>
    <div class="h-12 inset-x-0 bottom-0 absolute" style="top: 230px;">
        <div class="py-3 px-8 bg-yellow-100 text-black border-yellow-600 border-solid border-b">
            <h2 class="text-2xl">
                Forums
            </h2>
        </div>
    </div>
</div>

@endsection
@section('content')
<div class="bg-gray-300 flex flex-row xs:flex-col sm:flex-col py-12 px-6 xs:pr-6 xs:p-2 sm:pr-6 sm:p-2 h-full">
    <div class="flex-none flex flex-col items-center rounded-md xs:w-full sm:w-full w-2/12 p-3 m-3 bg-white">
    <div class="xs:hidden h-24 w-24 rounded-full mt-8 mb-5" style=" background-size:cover; background-image: url('/files/images?filename={{Auth::user()->avatar}}')"></div>
    <h3 class="font-bold xs:hidden"><span>{{Auth::user()->first_name}}</span> <span>{{Auth::user()->last_name}}</span></h3>
        <h3 class="xs:hidden">{{Auth::user()->email}}</h3>
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
            <div class="bg-white w-1/2 h-screen md:max-w-md mx-auto rounded shadow-lg py-4 mt-48 text-left px-6" x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Create Post</p>
                    <div class="cursor-pointer z-50" @click="open = false">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>
                <form action="{{route('save.post')}}" method="post">
                    @csrf
                    <div class="inline-block relative w-64">
                        <select name="categoryId" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                          <option>Choose a category</option>
                         @foreach ($categories as $item)
                        <option value="{{$item->id}}">{{$item->title}}</option>
                         @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                      </div>
                      <label class="block text-gray-700 text-sm font-bold m-2">
                        Post title
                      </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="title" type="text" placeholder="Enter Post Title">
                    <label class="block text-gray-700 text-sm font-bold m-2">
                       Write post content
                    </label>
                    <textarea name="content" id="content" cols="30" rows="30"></textarea>
                    <button class="font-semibold px-10 py-3 rounded-t bg-yellow-600">Post</button>
                </form>
            </div>
            <!--/Dialog -->
        </div><!-- /Overlay -->
    </div>
    </div>
    <div class="flex-1 flex m-3 p-6 w-6/12 xs:w-full sm:w-full rounded-lg bg-white justify-between items-start">
        <div class="flex-1 xs:px-2 xs:w-2/12 xs:m-2 sm:px-2 sm:w-2/12 sm:m-2 w-1/12">
            <div class="rounded-full h-12 w-12"
            style="background-image: url('/files/images?filename={{$post->user->avatar}}');
            background-size: cover">
            </div>
        </div>
        <div class="flex-none xs:w-10/12 sm:w-10/12 w-11/12">
        <h1 class="text-2xl font-bold">{{$post->title}}</h1>
        <span class="text-gray-500">By </span><span class="font-bold text-blue-400">{{$post->user->first_name}}</span> <span class="text-gray-500">On 23 Dec</span>

        <div class="flex-none">
             <!-- Sharingbutton Facebook -->
        <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=http://{{url()->full()}}" target="_blank" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                </div>
                </div>
            </a>

            <!-- Sharingbutton Twitter -->
            <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=puttext&amp;url=http%3Ammm" target="_blank" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
                </div>
                </div>
            </a>

            <!-- Sharingbutton E-Mail -->
            <a class="resp-sharing-button__link" href="mailto:?subject=puttext&amp;body=http%3Ammm" target="_self" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--email resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22 4H2C.9 4 0 4.9 0 6v12c0 1.1.9 2 2 2h20c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zM7.25 14.43l-3.5 2c-.08.05-.17.07-.25.07-.17 0-.34-.1-.43-.25-.14-.24-.06-.55.18-.68l3.5-2c.24-.14.55-.06.68.18.14.24.06.55-.18.68zm4.75.07c-.1 0-.2-.03-.27-.08l-8.5-5.5c-.23-.15-.3-.46-.15-.7.15-.22.46-.3.7-.14L12 13.4l8.23-5.32c.23-.15.54-.08.7.15.14.23.07.54-.16.7l-8.5 5.5c-.08.04-.17.07-.27.07zm8.93 1.75c-.1.16-.26.25-.43.25-.08 0-.17-.02-.25-.07l-3.5-2c-.24-.13-.32-.44-.18-.68s.44-.32.68-.18l3.5 2c.24.13.32.44.18.68z"/></svg>
                </div>
                </div>
            </a>

            <!-- Sharingbutton LinkedIn -->
            <a class="resp-sharing-button__link" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3Ammm&amp;title=puttext&amp;summary=puttext&amp;source=http%3Ammm" target="_blank" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"/></svg>
                </div>
                </div>
            </a>

            <!-- Sharingbutton WhatsApp -->
            <a class="resp-sharing-button__link" href="whatsapp://send?text=puttext%20http%3Ammm" target="_blank" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                </div>
                </div>
            </a>

            <!-- Sharingbutton Telegram -->
            <a class="resp-sharing-button__link" href="https://telegram.me/share/url?text=puttext&amp;url=http%3Ammm" target="_blank" rel="noopener" aria-label="">
                <div class="resp-sharing-button resp-sharing-button--telegram resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M.707 8.475C.275 8.64 0 9.508 0 9.508s.284.867.718 1.03l5.09 1.897 1.986 6.38a1.102 1.102 0 0 0 1.75.527l2.96-2.41a.405.405 0 0 1 .494-.013l5.34 3.87a1.1 1.1 0 0 0 1.046.135 1.1 1.1 0 0 0 .682-.803l3.91-18.795A1.102 1.102 0 0 0 22.5.075L.706 8.475z"/></svg>
                </div>
                </div>
            </a>
        </div>

        <div class="py-3"><span class="text-gray-500"><i class="fa fa-share-alt"></i> Share</span> <span class=" px-8 text-gray-500"><i class="fa fa-edit"></i> Edit</span></div>
            <hr class="bg-gray-500 mb-6 w-full">
            <div class="font-serif">{!! $post->content !!}</div>
            <div id="comments" class="mt-6">
            <span class="font-bold">{{$post->comments->count()}} Replies</span>
            <hr class="bg-gray-500 my-3 w-full">
            <div class="xs:ml-0">
               @foreach ($comments as $item)
               <div class="flex mb-2 rounded-lg">
                <div class="flex-none p-2">
                    <div class="rounded-full h-8 w-8"
                        style="background-image: url('/files/images?filename={{$item->user->avatar}}');
                        background-size: cover">
                    </div>
                </div>
                <div class="flex-1 ml-3 p-2 shadow">
                <span class="text-1xl font-semibold">{{$item->author}}</span> <span class="text-gray-500 text-xs">30 minutes ago</span>
                    <p class="ml-2 font-serif">{{$item->content}}</p>
                </div>
            </div>
               @endforeach
               {{$comments->links()}}
               <form action="#" class="w-full py-8">
                    @csrf
                    <input type="text" hidden value="{{$post->id}}" id="postId" name="postId">
                    <div class="flex items-center border-b border-b-2 border-yellow-500">
                      <textarea class="appearance-none bg-transparent border-none w-10/12 text-gray-700 py-1 leading-tight focus:outline-none" type="text" id="comment" name="content" placeholder="Write a comment" aria-label="Comment"></textarea>
                      <button class="bg-yellow-600 hover:bg-yellow-700 border-yellow-600 hover:border-yellow-700 text-sm border-4 text-white py-1 rounded" id="submit" type="submit">
                        Comment
                      </button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="flex-none px-3 bg-white m-3 xs:w-full sm:w-full w-3/12 rounded-lg p-5">
        <div class="h-64 bg-red-600 text-center text-white">
            Place adverts here
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
     document.querySelector( '#submit' ).addEventListener( 'click', (event) => {
        event.preventDefault()
        var postId = document.querySelector( '#postId' ).value
        var content = document.querySelector( '#comment' ).value

        var formdata = new FormData();
        formdata.append("postId", postId);
        formdata.append("content", content);

        var ajax = new XMLHttpRequest();
        ajax.responseType = 'json';
        ajax.open("POST", '/forum/comment/submit');
        ajax.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))// your url will pass to open method
        ajax.send(formdata)
        ajax.onreadystatechange = function() {
            if (ajax.readyState ===  XMLHttpRequest.DONE) {
            var status = ajax.status;
            if (status === 0 || (status >= 200 && status < 400)) {
                toastr.success('Comment posted');
                $("#comments").load(location.href+ " #comments");
                e.preventDefault();
                } else {
                toastr.warning('Please try again')
                }
            }
        }
    } );
   </script>
@endsection
