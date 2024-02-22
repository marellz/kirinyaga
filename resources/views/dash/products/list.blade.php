<x-dashboard-layout>

    @php
        $fields = [['key' => 'name', 'label' => 'Name'], ['key' => 'category_id', 'label' => 'Category'], ['key' => 'price', 'label' => 'Price'], ['key' => 'in_stock', 'label' => 'In stock'], ['key' => 'visible', 'label' => 'Visible']];
    @endphp

    <x-slot:header>
        <h1 class="text-2xl font-black text-gunmetal">My products</h1>
        <div class="flex items-center space-x-2" autocomplete="off">
            <a href="{{ route('dash.products.create') }}">
                <x-custom.button>Add new</x-custom.button>
            </a>
        </div>
    </x-slot>
    <x-layout.container x-data="{ product: {} }">
        <div class="flex flex-col">
            <div class="flex justify-end">
                <form route="{{ route('dash.products') }}">
                    <div class="flex items-center space-x-2">
                        <form-input name="query" model-value="{{ request()->query('query') }}"
                            placeholder="Search"></form-input>
                        <x-custom.button variant="secondary">
                            Search
                        </x-custom.button>
                    </div>
                </form>
            </div>
            <table class="table border rounded mt-3">
                <thead>
                    <tr>
                        @foreach ($fields as $field)
                            <x-dash.table-th>
                                {{ $field['label'] }}
                            </x-dash.table-th>
                        @endforeach
                        <x-dash.table-th>
                            Actions
                        </x-dash.table-th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <x-dash.table-td>
                                {{ $product->name }}
                            </x-dash.table-td>
                            <x-dash.table-td>
                                <p>
                                    {{ $product->category->name }}
                                </p>
                                @if ($product->subcategory_id)
                                    <p class="text-xs text-gray-500">
                                        {{ $product->subcategory->name }}
                                    </p>
                                @endif
                            </x-dash.table-td>
                            <x-dash.table-td>
                                Ksh. {{ number_format($product->price) }}
                            </x-dash.table-td>
                            <x-dash.table-td>
                                @if ($product->in_stock)
                                    <p class="">In stock</p>
                                @else
                                    <p class="text-red-600">Not in stock</p>
                                @endif
                            </x-dash.table-td>
                            <x-dash.table-td>
                                @if ($product->visible)
                                    <p class="">Visible</p>
                                @else
                                    <p class="text-gray-600">Hidden</p>
                                @endif
                            </x-dash.table-td>

                            <x-dash.table-td actions>
                                <a href="{{ route('dash.product.edit', [$product]) }}">
                                    <x-custom.button variant="secondary">Edit</x-custom.button>
                                </a>
                                <div>
                                    <x-custom.button x-data="" variant="danger"
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-product-delete-{{ $product->id }}')">Delete</x-custom.button>
                                    <x-utils.modal name="confirm-product-delete-{{ $product->id }}">
                                        <div class="p-5 space-y-4">
                                            <h1 class="text-lg font-bold">Delete this product? {{ $product->name }}
                                            </h1>
                                            <p class="text-lg">This action cannot be reversed.</p>

                                            <div class="flex items-center space-x-2">
                                                <x-custom.button type="button" variant="secondary"
                                                    x-on:click.prevent="$dispatch('close-modal','confirm-product-delete-{{ $product->id }}')">Cancel</x-custom.button>
                                                <form method="post"
                                                    action="{{ route('dash.product.delete', [$product]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-custom.button variant="danger">Delete</x-custom.button>

                                                </form>
                                            </div>
                                        </div>
                                    </x-utils.modal>
                                </div>
                            </x-dash.table-td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </x-layout.container>
</x-dashboard-layout>
