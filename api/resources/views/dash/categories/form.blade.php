<x-dashboard-layout>
    @php
        $editing = $category->id;
        $type = isset($parentCategory) ? 'subcategory' : 'category';
        $action = 'dash';
        $parameters = [];
        if(isset($parentCategory)){
             $action = $action.'.subcategory';
             array_push($parameters, $parentCategory);
        } else {
            $action = $action.'.category';
        }

        if($editing){
            $action =$action.'.update';
            array_push($parameters, $category);
        } else {
            $action =$action.'.store';
        }
    @endphp
    <x-slot:header>
        <h1 class="text-2xl font-black text-gunmetal">{{ $editing ? 'Update' : 'Create' }} {{ $type }}</h1>
        <div class="flex items-center">
            <a href="{{ route('dash.products') }}">
                <x-custom.button variant="secondary">Cancel</x-custom.button>
            </a>
        </div>
    </x-slot>

    <x-layout.container>
        <div class="flex justify-center">
            <div class="w-1/2">
                <form method="POST"
                    action="{{ route($action, $parameters) }}">
                    @csrf

                    @if ($editing)
                        @method('patch')
                    @endif

                    {{ $errors}}

                    <div class="space-y-5">
                        <form-input name="name" label="{{ ucfirst($type) }} name" error="{{ $errors->first('name') }}"
                            class="col-span-2" model-value="{{ old('name') ?? $category->name }}">
                        </form-input>

                        @if (isset($parentCategory) && isset($categories))
                            <form-select label="Category" model-value="{{ $category->category_id ?? $parentCategory->id }}" name="category_id"
                                placeholder="Select product category" error="{{ $errors->first('category_id') }}">
                                
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}" >
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                            </form-select>
                        @endif

                        <form-textarea name="description" label="Description" class="col-span-2"
                            error="{{ $errors->first('description') }}"
                            model-value="{{ old('description') ?? $category->description }}"></form-textarea>

                        <x-custom.button>{{ $editing ? 'Update' : 'Create' }} {{ $type }} </x-custom.button>
                    </div>
                </form>
            </div>
        </div>
    </x-layout.container>


</x-dashboard-layout>
