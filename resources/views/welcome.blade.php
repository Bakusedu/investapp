@extends('layouts.header')
@section('content')
<div class="xs:relative max-h-full sm:w-full md:w-full lg:w-full h-screen xl:w-full mx-auto sm:px-12 md:px-12 flex xs:mt-24
    flex-col-reverse sm:flex-row md:flex-row lg:flex-row xl:flex-row items-center">
    <div class="sm:w-2/5 md:w-2/5 lg:w-2/5 xl:w-2/5 flex flex-col items-start sm:mt-0 xs:pt-56 xs:px-20 xs:w-auto xs:absolute xs:inset-y-0 xs:inset-x-0 xs:top-0 p-12">
            <h1 class="text-4xl lg:text-6xl xl:text-6xl leading-none mb-4 text-gray-800"><strong>Rethinking</strong> where you work?</h1>
            <p class="xs:text-lg lg:text-lg xl:text-lg mb-12 xs:mb-5 sm:mb-12 md:mb-12 lg:mb-12 xl:mb-12">Wether you're an established enterprise or you're a growing startup, discover services that inspire your people's most important and impactful work</p>
            <a href="#" class="font-semibold shadow-lg text-lg bg-yellow-500 hover:bg-yellow-400 text-white xs:py-2 py-3 xs:px-5 px-10 rounded-full">@if(Auth::check())Goto Dashboard @else Get Started @endif</a>
    </div>
    <div style="background-image: url({{asset('images/work2.jpg')}}); background-size: cover" class="xs:bg-local bg-fixed lg:bg-fixed xs:h-48 h-full xs:absolute sm:w-3/5 md:w-3/5 lg:w-3/5 xl:w-3/5 flex-shrink xs:inset-y-0 xs:inset-x-0 xs:w-auto xs:top-0 xs:px-16 xs:pt-0">
        <img src="" class="w-full object-cover" alt="" srcset="">
    </div>
</div>
<div class="flex w-full p-16 pt-24 xs:p-4">
<div class="flex-1 w-6/12">
    <img src="{{asset('images/work.jpg')}}" class="object-fill w-full h-full" alt="">
</div>
<div class="flex-1 w-6/12 p-16 xs:p-4">
    <h1 class="font-bold xs:text-lg text-4xl">Where work feeels like fun.</h1>
    <p>Unlock the potentials of your company and the people in it.
        Transform your business drastically by relying on our feasible solution and community approach</p>
</div>
</div>

<div class="flex w-full p-16 pt-16 xs:p-4">
    <div class="flex-1 w-6/12 pt-8 xs:p-4">
        <h1 class="font-bold xs:text-lg text-4xl">Where work feeels like fun.</h1>
        <p>Unlock the potentials of your company and the people in it.
            Transform your business drastically by relying on our feasible solution and community approach</p>
    </div>
    <div class="flex-1 w-6/12">
        <img src="{{asset('images/work4.jpg')}}" class="object-fill w-full h-full" alt="">
    </div>
</div>

<footer class="p-16">
    <div class="flex flex-row justify-evenly">
        <div class="shadow py-6 px-8 hover:shadow-lg">
            Blog
        </div>
        <div class="shadow py-6 px-8 hover:shadow-lg">
            Programs
        </div>
        <div class="shadow py-6 px-8 hover:shadow-lg">
            Forum
        </div>
    </div>
</footer>

@endsection
