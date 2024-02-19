<x-main-layout>
    <x-layout.container>
        <x-layout.banner>
            <div class="flex justify-between">
                <x-type.page-title>
                    All products
                </x-type.page-title>

                <a href="{{ route('products.create')}}">
                    <x-custom.button>Create new</x-custom.button>
                </a>
            </div>
        </x-layout.banner>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-10">
            @foreach ($products as $item)
                <a href="{{ route('product.show', [$item]) }}">
                    <x-product.card :product="$item" />
                </a>
            @endforeach
        </div>
        <div class="flex justify-center py-10">
             {{ $products->links()}}
        </div>

    </x-layout.container>
</x-main-layout>