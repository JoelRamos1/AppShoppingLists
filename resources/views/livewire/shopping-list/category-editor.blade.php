<div>
    {{-- Stop trying to control. --}}
    <form wire:submit.prevent="newProduct" class="flex flex-row gap-2 mb-2">
        <flux:input
            wire:model="name"
            placeholder="{{ __('New Product') }}" />
        <flux:button icon="plus" variant="ghost" type="submit"/>
    </form>

    <div class="mx-2">
        @forelse ($category->products as $product)
            <div class="grid grid-cols-4 gap-1" wire:key="{{ $product->id }}">
                <div class="flex flex-row gap-1">
                    {{-- <input
                        type="checkbox"
                        @checked($product->is_completed)
                        wire:click="checkProduct({{ $product->id }})"
                    /> --}}
                    <flux:checkbox :checked="$product->is_completed"  wire:click="checkProduct({{ $product->id }})"/>
                    <input class="placeholder-black dark:placeholder-white {{$product->is_completed ? 'placeholder:line-through' : ''}}" type="text" placeholder="{{ $product->name }}" wire:model.defer="newProductNames.{{$product->id}}" wire:keydown.enter="updateProduct({{ $product->id }})" />
                    @if (count($product->tag))
                        <ul>
                        @foreach ($product->tag as $tag)
                            <li class="bg-yellow-200 rounded-2xl p-1">{{"#".$tag->name}}</li>
                        @endforeach
                        </ul>
                    @endif
                </div>
                <div class="grid grid-cols-2">
                    <form wire:submit="createTag({{ $product->id }})" class="grid grid-cols-2">
                        <flux:input type="text" placeholder="{{ __('New tag name') }}" wire:model="tagName" wire:key="{{ $product->id }}" />
                        {{-- <button type="submit">
                            <flux:icon.plus></flux:icon.plus>
                        </button> --}}
                        <flux:button icon="plus" type="submit" />
                    </form>
                    <button wire:click.prevent="deleteProduct({{ $product->id }})" type="button">
                        <flux:icon.trash />
                    </button>
                </div>
            </div>
        @empty
            <flux:text>{{ __('There are no products in this category. Create one above.') }}</flux:text>
        @endforelse
    </div>
</div>
