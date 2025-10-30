<div>
    {{-- Stop trying to control. --}}
    <form wire:submit.prevent="newProduct" class="flex flex-row gap-2">
        <flux:input
            wire:model="name"
            placeholder="{{ __('New Product') }}" />
        <flux:button icon="plus" variant="ghost" type="submit"/>
    </form>

    @forelse ($category->products as $product)
        <div class="flex flex-row gap-2">
            <div>
                <input
                    type="checkbox"
                    @checked($product->is_completed)
                    wire:click="checkProduct({{ $product->id }})"
                />
                <input type="text" placeholder="{{ $product->name }}" wire:model.defer="newProductNames.{{$product->id}}" wire:keydown.enter="updateProduct({{ $product->id }})" />
            </div>
            <div>
                <button wire:click.prevent="deleteProduct({{ $product->id }})" type="button">
                    <flux:icon.trash />
                </button>
            </div>
        </div>
    @empty
        <flux:text>{{ __('There are no products in this category. Create one above.') }}</flux:text>
    @endforelse
</div>
