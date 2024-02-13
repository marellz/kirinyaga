@props(['product'])

<div {{ $attributes->merge(['class'=> 'flex flex-wrap text-gray-500 font-bold items-center my-2 text-center'])}}>
    <a href="{{ route('products') }}">
        Products
    </a>
    <span>
        <x-icons.chevron-right size="h-4 w-4" />
    </span>
    <a href="{{ route('category', $product->category->slug) }}">
        {{ $product->category->name }}</a>
    <span>
        <x-icons.chevron-right size="h-4 w-4" />
    </span>
    <a
        href="{{ route('subcategory', ['category' => $product->category->slug, 'subcategory' => $product->subCategory->slug]) }}">
        {{ $product->subcategory->name }}</a>

</div>
