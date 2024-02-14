@props(['id', 'name'])

<div {{ $attributes->merge(['class'=> 'flex flex-col']) }}>
    <label :for="$id" class="">
        <input :id="$id" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            :name="$name">
        <span class="ms-2 text-sm text-gray-600">
            {{ $slot }}
        </span>
    </label>
</div>
