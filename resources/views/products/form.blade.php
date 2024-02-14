<x-main-layout>
    <x-layout.container>
        <x-layout.banner>
            <x-type.page-title>{{$product->id ? 'Update' : 'Create'}} product</x-type.page-title>
        </x-layout.banner>
        <form method="POST" action="{{ route('product.store') }}">
            @csrf
            <div class="grid grid-cols-2 gap-5">

                <form-input label="Product name" @if ($errors->hasAny()) :errors="true" @endif
                    class="col-span-2" model-value="{{ $product->name }}"></form-input>

                <form-textarea label="Short info" class="col-span-2"
                    model-value="{{ $product->short_info }}"></form-textarea>

                <product-categories category-id="{{ $product->category_id }}"
                    subcategory-id="{{ $product->subcategory_id }}"></product-categories>

                <form-textarea label="Description" class="col-span-2" model-value="{{ $product->description }}"
                    rows="10"></form-textarea>

                <div class="col-span-2 flex items-center space-x-3">
                    <form-checkbox label="In stock" :model-value="{{ $product->in_stock }}">In stock</form-checkbox>

                    <form-checkbox label="Visible" :input-value="true" :model-value="{{ (boolean)$product->visible }}">Visible</form-checkbox>

                </div>
                <div class="col-span-2">
                    <x-custom.button>{{$product->id ? 'Update' : 'Create'}} product</x-custom.button>
                </div>
            </div>
        </form>
    </x-layout.container>
</x-main-layout>
