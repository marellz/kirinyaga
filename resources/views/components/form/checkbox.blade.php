@props(['id', 'name'])

<label :for="$id" class="inline-flex items-center">
    <input :id="$id" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
        :name="$name">
    <span class="ms-2 text-sm text-gray-600">
        {{ $slot }}
    </span>
</label>
