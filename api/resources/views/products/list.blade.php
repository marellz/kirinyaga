<x-main-layout>
    <x-layout.container>
        @php
            $category_id = request()->get('category_id');
            $subcategory_id = request()->get('subcategory_id');
        @endphp
        <div class="grid grid-cols-4 py-20 gap-20">
            <div class="space-y-5 stick top-0">
                <h1 class="font-bold text-lg text-gray-600">Filters</h1>
                <form action="{{ route('products')}}">
                    <div class="space-y-5">
                        <product-category-loader category-id="{{ $category_id }}"
                            subcategory-id="{{ $subcategory_id }}"></product-category-loader>
                        <x-custom.button>Apply filters</x-custom.button>
                    </div>
                </form>
            </div>
            <div class="col-span-3 space-y-10">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-bold">Products</h1>
                    <form-input name="search" placeholder="Search">
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-10">
                    @foreach ($products as $item)
                        <a href="{{ route('product.show', [$item]) }}">
                            <x-product.card :product="$item" />
                        </a>
                    @endforeach
                </div>
                <div class="flex justify-center py-10">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </x-layout.container>
</x-main-layout>
