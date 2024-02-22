@props(['to' => '#'])

<li>
    <a href="{{ $to }}" class="block px-3 py-2 font-medium">
        {{ $slot }}
    </a>
</li>
