<x-home-layout>
    <main>
        <div>
            <div class="container mx-auto">
                <div class="flex justify-center mt-16">
                    <div class="text-center w-1/2 space-y-5">
                        <h1 class="text-[60px] font-bold">Welcome to <span class="text-red-crayola">Kirinyaga Online
                                Stores</span> </h1>
                        <p class="text-lg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis adipisci
                            repellendus quo dolore, dolores laboriosam. Nesciunt nostrum culpa eveniet, ex illo qui
                            ipsam neque quibusdam unde, veniam non sapiente consectetur.</p>

                        <a href="{{ route('products') }}" class="inline-block">
                            <x-custom.button>Browse our products</x-custom.button>
                        </a>
                    </div>
                </div>
            </div>
            @if ($photos->count())
                <div class="splide home-slider my-10" role="group" aria-label="Product images">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($photos as $photo)
                                <li class="splide__slide flex items-center">
                                    <img class="h-96" src="{{ asset('images/' . $photo) }}" alt="">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </main>
</x-home-layout>
