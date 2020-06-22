<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>The LiftHub</title>
        <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/switch.css')}}">
     <link href="{{ mix('css/app.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href={{asset("fontawesome/css/all.css")}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
            .duration-300 {
                transition-duration: 300ms;
            }
            .ease-in {
                transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
            }
            .ease-out {
                transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
            .scale-90 {
                transform: scale(.9);
            }
            .scale-100 {
                transform: scale(1);
            }
        </style>
    @yield('head')
    </head>
    <body class="relative flex h-screen w-screen overflow-y-hidden" x-data="{ isOpen: false }" @keydown.escape="isOpen = false">
        <header class="absolute flex flex-col flex-no-wrap items-center text-center inset-y-0 left-0 h-screen w-auto bg-teal-900" :class="{ 'block shadow-3xl': isOpen, 'xs:hidden': !isOpen }"
        @click.away="isOpen = false"
        x-show="true"
        x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 transform"
        x-transition:enter-end="opacity-100 transform"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 transform"
        x-transition:leave-end="opacity-0 transform">
               <div class="p-5 pt-16 pb-10">
                   <span class="px-4 py-3 bg-white rounded-full"><i class="fas fa-user-tie 3x"></i></span>
                </div>
                <ul class="flex flex-col justify-evenly">
                <a href="{{route('home')}}" title="Dashboard">
                    <li class="p-5 px-8 bg-teal-500">
                        <span class="text-2xl text-white"><i class="fas fa-inbox"></i></span>
                    </li>
                </a>
                <a href="{{route('programmes.index')}}" title="Programmes">
                    <li class="p-5 px-8">
                        <span class="text-2xl text-gray-300"><i class="fa fa-business-time"></i></span>
                    </li>
                </a>
                <a href="{{route('categories')}}" title="Forum">
                    <li class="p-5 px-8">
                        <span class="text-2xl text-gray-300"><i class="fa fa-business-time"></i></span>
                    </li>
                </a>
                <a href="#" title="Customer Management">
                    <li class="p-5 px-8">
                        <span class="text-2xl text-gray-300"><i class="fas fa-users-cog"></i></span>
                    </li>
                </a>
                <a href="#" title="Jobs">
                    <li class="p-5 px-8">
                        <span class="text-2xl text-gray-300"><i class="fas fa-toolbox"></i></span>
                    </li>
                </a>
                <a href="#" title="Settings">
                    <li class="p-5 px-8">
                        <span class="text-2xl text-gray-300"><i class="fas fa-cog"></i></span>
                    </li>
                </a>
            </ul>
        </header>
        <nav class="flex-1 flex flex-col px-10 pt-5 xs:w-screen absolute inset-y-0 right-0 h-12">
            <ul class="flex flex-row flex-shrink justify-between">
                <li>
                   <!--Toggle button (hidden on large screens)-->
                    <button @click="isOpen = !isOpen" type="button" class="block sm:hidden md:hidden lg:hidden xl:hidden px-2 text-gray-800 hover:text-teal-900 focus:outline-none focus:text-teal-900"
                        :class="{ 'transition transform-180': isOpen }"
                    >
                    <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path x-show="isOpen" class="text-gray-300" fill-rule="evenodd" clip-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        <path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    </svg>
                    </button>
                </li>
                <li>
                    <span class="xs:visible hidden p-1 px-2 bg-gray-400 rounded-md"><i class="fas fa-bell"></i></span>
                </li>
                <li class="px-4">
                    <span class="p-1 px-2 bg-gray-400 rounded-md"><i class="fas fa-bell"></i></span>
                </li>
                <li class="px-4">
                    <span class="p-1 px-2 rounded-md bg-gray-400"><i class="fas fa-calendar-alt"></i></span>
                </li>
                <li class="px-4">
                    <span class="p-2 text-gray-500"><i class="fas fa-th"></i></span>
                </li>
                <li class="px-4">
                 <img class="w-8 h-8 rounded-full" src="/files/images?filename={{Auth::user()->avatar}}" alt="">
                </li>
            </ul>
        </nav>
        <div class="flex-row w-full inset-y-auto xs:pl-0 pl-20 pt-16 left-0" id="main">
            @yield('content')
        </div>

    <script src={{asset('js/alpine.js')}}></script>
        <script src={{asset("js/jquery.min.js")}}></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    </body>
</html>
