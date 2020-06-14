<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The LiftHub</title>
        <!-- Styles -->
     <link href="{{ mix('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="{{asset('css/share.css')}}">
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
    </head>
    <body>
        <main class="bg-white font-montserrat h-full">
            <nav class="flex items-center justify-between flex-wrap py-4 px-6 fixed w-full z-50 top-0"
                x-data="{ isOpen: false }"
                @keydown.escape="isOpen = false"
                :class="{ 'shadow-lg bg-gray-100' : isOpen , 'bg-white shadow-lg' : !isOpen}"
            >

                <!--Logo etc-->
                <div class="flex items-center flex-shrink-0 text-yellow-500 mr-6">
                    <a class="text-yellow-500 no-underline hover:text-yellow-600 hover:no-underline" href="/">
                        <img class="w-24" src="{{asset('images/160290cdb0652b0525e8191290986af1.png')}}" alt="">
                    </a>
                </div>

                <!--Toggle button (hidden on large screens)-->
                <button @click="isOpen = !isOpen" type="button" class="block sm:hidden md:hidden lg:hidden xl:hidden px-2 text-gray-800 hover:text-yellow-900 focus:outline-none focus:text-yellow-900"
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
                            <a href="{{route('forum.home')}}" class="rounded-full hover:shadow-lg inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-600 py-2 px-4" @click="isOpen = false">Forum</a>
                        </li>
                        <li class="mr-3">
                            <a href="{{route('programme.join')}}" class="@if(Request::is('join/programme')) shadow-lg @endif rounded-full hover:shadow-lg inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-600 py-2 px-4" @click="isOpen = false">Programmes</a>
                        </li>
                        <li class="mr-3">
                          <a href="https://blog.lifthub.org/" class="rounded-full hover:shadow-lg inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-600 py-2 px-4" @click="isOpen = false">Blog</a>
                        </li>
                        @auth
                        <li class="mr-3">
                        <a href="{{route('user.dashboard')}}" class="rounded-full hover:shadow-lg inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-600 py-2 px-4"  @click="isOpen = false">Dashboard</a>
                        </li>
                        @endauth
                        @unless (Auth::check())
                        <li class="mr-3">
                        <a class="rounded-full inline-block  text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-600 py-2 px-4" href="{{route('login')}}" @click="isOpen = false">Login</a>
                        </li>
                        <li class="mr-3">
                        <a class="rounded-full inline-block text-gray-600 no-underline hover:text-white hover:text-underline hover:bg-yellow-600 py-2 px-4" href="{{route('register')}}" @click="isOpen = false">Register</a>
                        </li>
                        @endunless
                    </ul>
                </div>

            </nav>

            @yield('content')

    </main>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
              if ($(document).scrollTop() > 2) {
                $("nav").addClass("transition duration-500 ease-in-out transform -translate-y-1 scale-x-100 opacity-75");
              } else {
                $("nav").removeClass("transition duration-500 ease-in-out transform -translate-y-1 scale-104  opacity-75");
              }
            });
          });
        </script>
</body>
</html>

