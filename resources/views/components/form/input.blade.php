@props([
    'label',
    'disabled' => false,
    'errors',
    'id' => Str::random(10),
    'name',
    'required' => false,
    'type' => 'text',
])

<div class="flex flex-col">
    <label for="{{ $id }}" class='block font-medium text-sm text-gray-700 mb-2'>
        {{ $label ?? $slot }}
    </label>
    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        name="{{ $name }}" type="{{ $type }}" id="{{ $id }}" {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }} />
</div>
@if ($errors)
    <ul class="mt-2 text-sm text-red-600 space-y-1">
        @foreach ((array) $errors as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
