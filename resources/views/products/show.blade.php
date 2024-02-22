<x-main-layout>
    <x-layout.container>
        <x-product.breadcrumb :product="$product" class="py-5" />
        <div class="space-y-10">
            <div class="">
                <x-layout.banner>
                    @auth
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('dash.product.edit', [$product]) }}">
                            <x-custom.button variant="secondary">Edit product</x-custom.button>
                        </a>
                    </div>
                    @endauth

                    <x-type.page-title>
                        {{ $product->name }}
                    </x-type.page-title>

                    <p class="mt-5">
                        {{ $product->short_info }}
                    </p>
                </x-layout.banner>

                <div class="flex items-center space-x-3 py-10">
                    <p class="font-bold">
                        Ksh. {{ number_format($product->price) }}
                    </p>

                    <x-custom.button>Purchase</x-custom.button>
                </div>
            </div>

            <div>
                @if (count($product->photos))
                    <div class="splide product-images" role="group" aria-label="Product images">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($product->photos as $photo)
                                    <li class="splide__slide flex items-center">
                                        <img class="object-cover lg:w-96 h-96 rounded" src="{{ $photo->url }}"
                                            alt="">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @else
                <div>
                    <div class="py-5 text-center">
                        <p class="text-xl">No photos added.</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="">
                <div class="bg-white border rounded-xl">

                    <h1 class="p-3 text-xl font-bold">
                        Description
                    </h1>

                    <hr>

                    <div class="p-3 pb-8">
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 py-10">
                    <form method="post" action="{{ route('product.delete', [$product]) }}">
                        @method('delete')
                        @csrf
                        <x-custom.button variant="danger">Delete product</x-custom.button>
                    </form>
                </div>
            </div>
        </div>

    </x-layout.container>

    <x-slot:scripts>
        @vite(['resources/js/splide.js'])
    </x-slot>

</x-main-layout>
