<x-main-layout>
    @php
        $editing =  $product->id;
    @endphp
    <x-layout.container>
        <x-layout.banner>
            <x-type.page-title>{{ $editing ? 'Update' : 'Create' }} product</x-type.page-title>
        </x-layout.banner>

        <form method="POST" action="{{ $editing ? route('product.update', [$product]) : route('product.store') }}">
            @csrf

            @if($editing)
            @method('patch')
            @endif

            <div class="grid grid-cols-2 gap-5">
                <form-input name="name" label="Product name" error="{{ $errors->first('name') }}" class="col-span-2"
                    model-value="{{ old('name') ?? $product->name }}">
                </form-input>

                <form-textarea name="short_info" label="Short info" class="col-span-2" error="{{ $errors->first('short_info') }}"
                    model-value="{{ old('short_info') ?? $product->short_info }}"></form-textarea>

                <product-category-loader category-id="{{ old('category_id') ?? $product->category_id }}"
                    category-error="{{ $errors->first('category_id') }}"
                    subcategory-id="{{ $product->subcategory_id }}"></product-category-loader>

                <form-input name="price" type="number" label="Price" error="{{ $errors->first('price') }}"
                    model-value="{{ old('price') ?? $product->price }}">
                </form-input>

                <form-textarea name="description" label="Description" class="col-span-2" error="{{ $errors->first('description') }}"
                    model-value="{{ old('description') ?? $product->description }}" rows="10"></form-textarea>

                <div class="col-span-2 flex items-center space-x-3">
                    <form-checkbox name="in_stock" label="In stock" input-value="1" :model-value="{{ old('in_stock') ?? $product->in_stock ?? 'true' }}">In stock</form-checkbox>

                    <form-checkbox name="visible" label="Visible" input-value="1"
                        :model-value="{{ old('visible') ?? $product->visible  ?? 'true'}}">Visible</form-checkbox>
                </div> 
                <div class="col-span-2">
                    <x-custom.button>{{ $editing ? 'Update' : 'Create' }} product</x-custom.button>
                </div>
            </div>
        </form>
    </x-layout.container>
</x-main-layout>
