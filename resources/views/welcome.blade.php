@extends('layouts.header')
@section('content')
<div class="xs:relative max-h-full sm:w-full md:w-full lg:w-full h-screen xl:w-full mx-auto px-6 sm:px-12 md:px-12 lg:px-12 xl:px-12 flex mt-24
    md:mt-18 flex-col-reverse sm:flex-row md:flex-row lg:flex-row xl:flex-row items-center">
    <div class="sm:w-2/5 md:w-2/5 lg:w-2/5 xl:w-2/5 flex flex-col items-start mt-8 sm:mt-0 pt-32 xs:pt-56 xs:px-20 xs:w-auto xs:absolute xs:inset-y-0 xs:inset-x-0 xs:top-0">
            <h1 class="text-4xl lg:text-6xl xl:text-6xl leading-none mb-4 text-gray-800"><strong>Team Work</strong> Process</h1>
            <p class="xs:text-lg lg:text-lg xl:text-lg mb-12 xs:mb-5 sm:mb-12 md:mb-12 lg:mb-12 xl:mb-12">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam</p>
            <a href="#" class="font-semibold shadow-lg text-lg bg-teal-500 hover:bg-teal-400 text-white xs:py-2 py-3 xs:px-5 px-10 rounded-full">Get Started</a>
    </div>
    <div class="xs:absolute sm:w-3/5 md:w-3/5 lg:w-3/5 xl:w-3/5 pt-40 flex-shrink xs:inset-y-0 xs:inset-x-0 xs:w-auto xs:top-0 xs:px-20 xs:pt-0">
        <img src="{{asset('images/undraw_co-working_825n.svg')}}" alt="" srcset="">
    </div>
</div>

@endsection
