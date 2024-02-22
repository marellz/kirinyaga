<x-dashboard-layout>
    @php
        $editing = $product->id;
        $inStock = $product->in_stock ? 1 : 0;
        $visible = $product->visible ? 1 : 0;
    @endphp
    <x-slot:header>
        <h1 class="text-2xl font-black text-gunmetal">{{ $editing ? 'Update' : 'Create' }} product</h1>
        <div class="flex items-center">
            <a href="{{ route('dash.products') }}">
                <x-custom.button variant="secondary">Cancel</x-custom.button>
            </a>
        </div>
    </x-slot>
    <x-layout.container>

        <form method="POST"
            action="{{ $editing ? route('dash.product.update', [$product]) : route('dash.product.store') }}">
            @csrf

            @if ($editing)
                @method('patch')
            @endif

            <div class="grid grid-cols-2 gap-5">
                <form-input name="name" label="Product name" error="{{ $errors->first('name') }}" class="col-span-2"
                    model-value="{{ old('name') ?? $product->name }}">
                </form-input>

                <form-textarea name="short_info" label="Short info" class="col-span-2"
                    error="{{ $errors->first('short_info') }}"
                    model-value="{{ old('short_info') ?? $product->short_info }}"></form-textarea>

                <product-category-loader category-id="{{ old('category_id') ?? $product->category_id }}"
                    category-error="{{ $errors->first('category_id') }}"
                    subcategory-id="{{ $product->subcategory_id }}"></product-category-loader>

                <form-input name="price" type="number" label="Price" error="{{ $errors->first('price') }}"
                    model-value="{{ old('price') ?? $product->price }}">
                </form-input>

                <form-textarea name="description" label="Description" class="col-span-2"
                    error="{{ $errors->first('description') }}"
                    model-value="{{ old('description') ?? $product->description }}" rows="10"></form-textarea>

                
                    <form-group label="In stock" class="flex">
                        <form-radio name="in_stock" input-value="0" model-value="{{ $inStock }}"
                            label="Not in stock"></form-radio>
                        <form-radio name="in_stock" input-value="1" model-value="{{ $inStock }}"
                            label="In stock"></form-radio>
                    </form-group>

                    <form-group label="Visible" class="flex">
                        <form-radio name="visible" input-value="0" model-value="{{ $visible }}"
                            label="Hidden"></form-radio>
                        <form-radio name="visible" input-value="1" model-value="{{ $visible }}"
                            label="Visible"></form-radio>
                    </form-group>
                
                <div class="col-span-2 mt-10">
                    <x-custom.button>{{ $editing ? 'Update' : 'Create' }} product</x-custom.button>
                </div>
            </div>
        </form>
    </x-layout.container>
</x-dashboard-layout>
