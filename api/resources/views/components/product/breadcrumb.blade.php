@props(['product'])

<div {{ $attributes->merge(['class' => 'flex flex-wrap text-gray-500 font-bold items-center my-2 text-center']) }}>
    <a href="{{ route('products') }}">
        Products
    </a>
    <span>
        <x-icons.chevron-right size="h-4 w-4" />
    </span>
    <a href="{{ route('products', ['query'=> ['category' => $product->category->slug]]) }}">
        {{ $product->category->name }}
    </a>
    
    @if ($product->subcategory_id)
    <span>
        <x-icons.chevron-right size="h-4 w-4" />
    </span>
    <a
        href="{{ route('products', ['query'=> ['category' => $product->category->slug, 'subcategory' => $product->subcategory->slug]]) }}">
        {{ $product->subcategory->name }}</a>
    @endif

</div>
