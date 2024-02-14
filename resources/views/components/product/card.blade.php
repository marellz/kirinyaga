@props(['product'])


@php
    $unavailable = !$product->in_stock;
    
    $bannerImage = 'https://placehold.co/600x400?text=No+image';
    
    if(count($product->photos)){
        $bannerImage = $product->photos[0]['url'];
    }

@endphp

<div class="@if ($unavailable) opacity-75 @endif">
    <img class="h-64 w-full object-cover rounded-lg" src="{{ $bannerImage }}" alt="">
    <div class="mt-2">
        <h1 class="font-bold mb-2 text-lg">{{ $product->name }}</h1>
        <p class="font-lg text-sm text-gray-500">{{ $product->short_info }} </p>

        @if ($unavailable)
            <p class="mt-5 font-medium text-gray-500">Out of stock</p>
        @else
            <p class="mt-5 font-medium">Ksh. {{ number_format($product->price) }}</p>
        @endif
    </div>

    {{}}
</div>

