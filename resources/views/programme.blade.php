@extends('layouts.header')
@section('content')
        @php
            function substrwords($text, $maxchar, $end='...') {
            if (strlen($text) > $maxchar || $text == '') {
                $words = preg_split('/\s/', $text);
                $output = '';
                $i      = 0;
                while (1) {
                    $length = strlen($output)+strlen($words[$i]);
                    if ($length > $maxchar) {
                        break;
                    }
                    else {
                        $output .= " " . $words[$i];
                        ++$i;
                    }
                }
                $output .= $end;
            }
            else {
                $output = $text;
            }
            return $output;
        }
        @endphp
    <div class="flex flex-wrap pt-20 px-6 justify-center">
        @foreach ($programmes as $item)
            <div class="flex-none xs:w-11/12 w-3/12 m-4 text-center">
                @if ($item->type = 'free')
                <div class="absolute border bg-green-600 h-10 w-10 justify-center" style="border-bottom-right-radius: 50%;">
                    <div class="flex items-center text-white pt-2 text-center justify-center">
                      {{$item->type}}
                    </div>
                </div>
                @else
                <div class="absolute border h-10 w-10 bg-orange-600 justify-center" style="border-bottom-right-radius: 50%;">
                    <div class="flex items-center pt-2 text-white text-center justify-center">
                       {{$item->type}}
                    </div>
                </div>
                @endif
                <a href="{{route('programme.details', ['id'=>$item->id])}}">
                <div class="shadow-md rounded-md flex items-center justify-center hover:shadow-2xl h-64" style="background-image: url('/files/images?filename={{$item->featured}}'); background-size: cover">
                </div>
                <div class="flex-1 text-left flex-row p-3">
                    <p class="font-semibold text-xl mb-2">{{$item->title}}</p>
                    <p class="text-gray-500 xs:text-sm text-base">Duration: {{\Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::now()->addDays($item->duration), \Carbon\CarbonInterface::DIFF_ABSOLUTE)}}</p>
                    <p class="py-1 xs:text-sm text-gray-700">{{substrwords($item->overview, 100)}} <span class="px-2 text-base xs:text-sm font-semibold text-blue-700">Join Now</span></p>
                </div>
            </a>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col items-center">
        {{$programmes->links()}}
    </div>
@endsection
