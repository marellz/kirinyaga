@extends('layouts.app')
@section('body')
    <div class="flex h-full min-h-[100vh]" id="app">
        <nav x-data="{ open: false }" class="overflow-auto bg-gray-100 w-72 ">

            @php
                $links = [
                    [
                        'label' => 'Home',
                        'path' => route('dash.home'), // route
                    ],
                    [
                        'label' => 'Products',
                        'path' => route('dash.products'), // route
                    ],
                    [
                        'label' => 'Categories',
                        'path' => route('dash.categories'), // route
                    ],
                ];
            @endphp

            <div class="mt-20 flex justify-center">
                <ul>
                    @foreach ($links as $link)
                        <x-dash.link :to="$link['path']">
                            {{ $link['label'] }}</x-dash.link>
                    @endforeach
                </ul>
            </div>
        </nav>
        <div class="flex-auto border overflow-auto">
            <header>
                <div class="border-b py-3">
                    <x-layout.container>
                        <div class="flex">
                            <a href="{{ route('dash.home') }}">
                                <x-img.logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>

                        </div>
                    </x-layout.container>
                </div>

                @if (isset($header))
                    <div class="border-b py-3">
                        <x-layout.container class="flex justify-between">
                            {{ $header }}
                        </x-layout.container>
                    </div>
                @endif
            </header>
            <main class="py-10">
                {{ $slot }}
            </main>
        </div>
    </div>
@endsection
