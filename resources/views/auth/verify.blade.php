@extends('layouts.header')

@section('content')
@section('content')
<div class=" max-h-full sm:w-1/1 md:w-full lg:w-full h-screen xl:w-full mx-auto px-6 sm:px-12 md:px-12 lg:px-12 xl:px-12 flex mt-24
    md:mt-18 xs:flex-col sm:flex-row md:flex-row lg:flex-row xl:flex-row">
    <div class="xs:w-full sm:w-full w-1/2 items-center">
        <div class="col-md-8">
            <div class="shadow">
                <div class="bg-gray-200 p-3">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="bg-orange-400 rounded p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
