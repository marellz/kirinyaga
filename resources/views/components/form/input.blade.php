@props(['label', 'disabled' => false, 'errors', 'id' => Str::random(10), 'name'])

<div class="flex flex-col">
    <label for="{{ $id }}" class='block font-medium text-sm text-gray-700'>
        {{ $label ?? $slot }}
    </label>
    <input name="{{ $name }}"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        {{ $disabled ? 'disabled' : '' }} />
</div>
@if ($errors)
    <ul class="mt-2 text-sm text-red-600 space-y-1">
        @foreach ((array) $errors as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
