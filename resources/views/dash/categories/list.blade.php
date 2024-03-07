<x-dashboard-layout>
    <x-slot:header>
        <h1 class="text-2xl font-black text-gunmetal">Categories</h1>
        <div class="flex items-center space-x-2" autocomplete="off">
            <a href="{{ route('dash.category.create') }}">
                <x-custom.button>Add new</x-custom.button>
            </a>
        </div>
    </x-slot>
    <x-layout.container>
        <div class="grid grid-cols-3 gap-10">
            @foreach ($categories as $category)
            <div>
                <div class="border rounded bg-white">
                    <div class="p-3 border-b flex items-center justify-between">
                        <h1 class="font-bold text-xl">
                            {{ $category->name}}
                        </h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('dash.category.edit', [$category]) }}">
                                <x-custom.button variant="secondary" icon="icons.edit">
                                            </x-custom.button>
                            </a>
                             <x-custom.button icon="icons.trash">
                             </x-custom.button>
                        </div>
                    </div>
                    <div class="p-3 border-b">
                        <p class="text-gray-600">
                            {{ $category->description}}
                        </p>
                    </div>
                    <div class="p-3 border-b">
                        <p class="font-medium">Subcategories</p>
                    </div>
                    
                    <ul>
                        @foreach($category->subCategories as $subcategory)
                        <li class="border-b last:border-0 px-3 py-2">
                            <div class="flex items-center mb-2">
                                <p class="font-medium flex-auto">
                                    {{ $subcategory->name }}
                                </p>
                                <div class="flex space-x-2">
                                    <a href="{{ route('dash.subcategory.edit', [$category, $subcategory]) }}">
                                        <x-custom.button variant="secondary" icon="icons.edit">
                                        </x-custom.button>
                                    </a>
                                    <x-custom.button variant="secondary" icon="icons.trash">
                                    </x-custom.button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500">
                                {{ $subcategory->description}}
                            </p>
                        </li>
                        @endforeach
                        <li>
                            <div class="text-center p-3">
                               <a href="{{ route('dash.subcategory.create', [$category]) }}">
                                <x-custom.button icon="icons.plus">
                                    <span>Add new</span>
                                </x-custom.button>
                               </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </x-layout.container>
</x-dashboard-layout>