@props(['actions'=>false])

<td class="font-medium text-sm p-3">
    <span class="@if($actions) flex itms-center space-x-2 flex-wrap @endif">
        {{ $slot }}
    </span>
</td>
