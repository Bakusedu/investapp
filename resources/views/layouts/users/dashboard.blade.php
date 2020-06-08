<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>The LiftHub</title>
        <!-- Styles -->
     <link href="{{ mix('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/share.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="{{asset('corner-popup-master/dist/css/corner-popup.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>

            .duration-200 {
                transition-duration: 200ms;
            }
            .ease-in {
                transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
            }
            .ease-out {
                transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }

          .transition {
            transition: transform 250ms ease, color 250ms ease;
          }
          .transform-180 {
            transform: rotate(-180deg);
          }

          </style>
          <script src="https://cdn.tiny.cloud/1/16mjg8w5uowhodrmhwys0l715tqywmv5m2awzf4q5nqq5fh2/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
          <script> tinymce.init({
              selector: 'textarea#content',
              plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
              toolbar: 'a11ycheck addcomment showcomments casechange checklist',
              toolbar_mode: 'floating',
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
            });</script>
          @yield('head')
    </head>
    <body>
            <nav class="flex items-center justify-between flex-wrap py-4 px-6 fixed w-full z-50 top-0"
                x-data="{ isOpen: false }"
                @keydown.escape="isOpen = false"
                :class="{ 'shadow-lg bg-gray-100' : isOpen , 'bg-yellow-100' : !isOpen}"
            >

                <!--Logo etc-->
                <div class="flex items-center mr-6">
                    <a class="text-yellow-500 no-underline hover:text-yellow-600 hover:no-underline" href="/">
                    <img class="w-24" src="{{asset('images/160290cdb0652b0525e8191290986af1.png')}}" alt="">
                    </a>
                    <div class="pt-2 pl-6 relative mx-auto text-gray-600">
                        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                          type="search" name="search" placeholder="Search Forum">
                        <button type="submit" class="absolute right-0 top-0 mt-5 mr-6">
                          <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                            width="512px" height="512px">
                            <path
                              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                          </svg>
                        </button>
                    </div>
                </div>

                <!--Toggle button (hidden on large screens)-->
                <button @click="isOpen = !isOpen" type="button" class="block right-0 sm:hidden xs:fixed md:hidden lg:hidden xl:hidden text-gray-800 hover:text-yellow-900 focus:outline-none focus:text-yellow-900"
                    :class="{ 'transition transform-180': isOpen }"
                >
                <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path x-show="isOpen" fill-rule="evenodd" clip-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    <path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
                </button>
                <!--Menu-->

                <div class="w-full flex-grow sm:flex sm:items-center sm:w-auto md:flex md:items-center md:w-auto lg:flex lg:items-center lg:w-auto xl:flex xl:items-center xl:w-auto"
                    :class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }"
                    @click.away="isOpen = false"
                    x-show="true"
                    x-transition:enter="ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform"
                    x-transition:enter-end="opacity-100 transform"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform"
                    x-transition:leave-end="opacity-0 transform"
                >
                    <ul class="pt-6 sm:pt-0 md:pt-0 lg:pt-0 xl:pt-0 list-reset sm:flex md:flex lg:flex xl:flex justify-end flex-1 items-center">
                        <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-yellow-500 no-underline" href="{{route('user.dashboard')}}" @click="isOpen = false">Home</a>
                        </li>
                        <li class="mr-3">
                        <a class="inline-block text-gray-600 @if(Request::is('forum/home')) shadow-lg @endif rounded-full no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="{{route('forum.home')}}" @click="isOpen = false">Forum</a>
                        </li>
                        @auth
                        <li class="mr-3">
                        <a class="@if(Request::is('dashboard')) shadow-lg @endif rounded-full inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-400 py-2 px-4" href="{{route('user.dashboard')}}" @click="isOpen = false">Dashboard</a>
                        </li>
                        <li class="mr-3">
                            <div class="rounded-full h-12 w-12 flex items-center justify-center" style="background-image: url('/files/images?filename={{Auth::user()->avatar}}'); background-size: cover"></div>
                        </li>
                        @endauth
                        @unless (Auth::check())
                        <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="{{route('login')}}" @click="isOpen = false">Login</a>
                        </li>
                        <li class="mr-3">
                        <a class="rounded-full shadow-lg inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-400 py-2 px-4" href="{{route('register')}}" @click="isOpen = false">Register</a>
                        </li>
                        @endunless
                    </ul>
                </div>
            </nav>
            @yield('header')
            @yield('content')

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     @yield('script')
    <script>
    $(document).ready(function() {
        $(window).scroll(function() {
          if ($(document).scrollTop() > 2) {
            $("nav").addClass("transition duration-500 ease-in-out transform -translate-y-1 scale-104 opacity-75");
          } else {
            $("nav").removeClass("transition duration-500 ease-in-out transform -translate-y-1 scale-104 opacity-75");
          }
        });
      });
    </script>
</body>
</html>

