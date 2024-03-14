@props(['variant' => 'primary', 'icon' => null])
@php
    $variants = [
        'primary' => ' bg-red-crayola border-transparent text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-indigo-500',
        'secondary' => 'border bg-gray-200 border-gray-300 hover:bg-gray-300 focus:ring-indigo-500 disabled:opacity-25',
        'danger' => 'border border-transparent bg-red-600  text-white uppercase hover:bg-red-500 active:bg-red-700 focus:ring-red-500',
];
@endphp

<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center rounded-md font-semibold text-sm focus:ring-2 focus:outline-none focus:ring-offset-2 px-4 py-2 transition ease-in-out duration-150'. $variants[$variant],
    ]) }}>
    
    <span>
        {{ $slot }}
    </span>
    @if($icon)
    <x-dynamic-component :component="$icon" size="w-4 h-4" />
    @endif
</button>
