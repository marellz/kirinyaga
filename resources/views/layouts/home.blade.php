@extends('layouts.app')
@section('body')
    <main id="app">
        <div class="py-10">
            <x-nav.header theme="" />
        </div>
    </main>
    <div>
        {{ $slot }}
    </div>


    @vite(['resources/js/splide.js'])
@endsection
