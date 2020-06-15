@extends('layouts.header')
@section('content')<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="xs:relative max-h-full sm:w-full md:w-full lg:w-full h-screen xl:w-full mx-auto sm:px-12 md:px-12 flex xs:mt-24
    flex-col-reverse sm:flex-row md:flex-row lg:flex-row xl:flex-row items-center">
    <div class="sm:w-2/5 md:w-2/5 lg:w-2/5 xl:w-2/5 flex flex-col items-start sm:mt-0 xs:pt-56 xs:px-20 xs:w-auto xs:absolute xs:inset-y-0 xs:inset-x-0 xs:top-0 p-12">
            <h1 class="text-4xl lg:text-6xl xl:text-6xl leading-none mb-4 text-gray-800"><strong>Rethinking</strong> where you work?</h1>
            <p class="xs:text-lg lg:text-lg xl:text-lg mb-12 xs:mb-5 sm:mb-12 md:mb-12 lg:mb-12 xl:mb-12">Wether you're an established enterprise or you're a growing startup, discover services that inspire your people's most important and impactful work</p>
    <a href="{{route('user.dashboard')}}" class="font-semibold shadow-lg text-lg bg-yellow-600 hover:bg-yellow-400 text-white xs:py-2 py-3 xs:px-5 px-10 rounded-full">@if(Auth::check())Dashboard @else Get Started @endif</a>
    </div>
    <div style="background-image: url({{asset('images/work2.jpg')}}); background-size: cover" class="xs:bg-local bg-fixed lg:bg-fixed xs:h-48 h-full xs:absolute sm:w-3/5 md:w-3/5 lg:w-3/5 xl:w-3/5 flex-shrink xs:inset-y-0 xs:inset-x-0 xs:w-auto xs:top-0 xs:px-16 xs:pt-0">
        <img src="" class="w-full object-cover" alt="" srcset="">
    </div>
</div>
<div class="flex w-full p-16 xs:pt-6 pt-24 xs:p-4 xs:flex-col">
<div class="flex-1 w-6/12 xs:flex-none xs:w-full">
    <img src="{{asset('images/work.jpg')}}" class="object-fill w-full h-full" alt="">
</div>
<div class="flex-1 w-6/12 p-16 xs:p-4 xs:w-full xs:flex-none">
    <h1 class="font-bold xs:text-lg text-4xl">Where work feeels like fun.</h1>
    <p>Unlock the potentials of your company and the people in it.
        Transform your business drastically by relying on our feasible solution and community approach</p>
</div>
</div>

<div class="flex w-full p-16 pt-16 xs:p-4 xs:flex-col-reverse">
    <div class="flex-1 w-6/12 pt-8 xs:w-full xs:flex-none xs:p-4">
        <h1 class="font-bold xs:text-lg text-4xl">Where work feeels like fun.</h1>
        <p>Unlock the potentials of your company and the people in it.
            Transform your business drastically by relying on our feasible solution and community approach</p>
    </div>
    <div class="flex-1 w-6/12 xs:w-full xs:flex-none">
        <img src="{{asset('images/work4.jpg')}}" class="object-fill w-full h-full" alt="">
    </div>
</div>
<div class="h-10 p-16 xs:text-sm xs:w-full mb-16">
    Follow The LiftHub
    <div class="flex-none">
        <a href="https://web.facebook.com/thelifthub/" class="fab fa-facebook"></a>
        <a href="https://twitter.com/thelifthub" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="https://chat.whatsapp.com/JIenKYuZ9t42NbqACYiXfn" title="Whatsapp" class="bg-green-500 fab fa-whatsapp"></a>
   </div>
</div>
<footer class="p-16 h-64 text-white bg-gray-900">
    <div class="flex flex-row xs:flex-col justify-evenly">
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
<div class="p-6 text-white bg-gray-900 text-center">
    ©LiftHub {{\Carbon\Carbon::now()->year}}
</div>
@endsection
