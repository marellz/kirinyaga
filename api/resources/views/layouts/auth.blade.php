@extends('layouts.app')
@section('body')
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-40 bg-gray-100 px-4" id="app">
        <div>
            <a href="/">
                <x-img.logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
@endsection
