@props([
    'label',
    'disabled' => false,
    'value' => null,
    'errors' => [],
    'id' => Str::random(10),
    'name' => null,
    'required' => false,
    'type' => 'text',
])

<div {{ $attributes->merge(['class'=> 'flex flex-col']) }}>
    <label for="{{ $id }}" class='block font-medium text-sm text-gray-700 mb-2'>
        {{ $label ?? $slot }}
    </label>
    <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        name="{{ $name }}" id="{{ $id }}" {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }} value ={{ $value }}>
        
        {{ $slot}}

    </select>

    @if ($errors->count)
        <ul class="mt-2 text-sm text-red-600 space-y-1">
            @foreach ($errors as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
</div>
