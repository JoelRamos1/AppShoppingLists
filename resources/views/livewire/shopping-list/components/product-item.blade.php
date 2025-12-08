<div class="w-full flex items-center gap-2">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <flux:field variant="inline">
        <flux:checkbox :checked="$product->is_completed" wire:click="checkProduct()" />
        <flux:label class="{{ $product->is_completed ? 'line-through' : '' }}">{{ $product->name }}</flux:label>
    </flux:field>
    @if ($product->tag->isNotEmpty())
        <ul class="flex gap-1">
            @foreach ($product->tag as $tag)
                <livewire:shopping-list.components.tag-list :tag="$tag" :key="$tag->id" lazy/>
            @endforeach
        </ul>
    @endif
    <form wire:submit="createTag" class="flex flex-row gap-2">
        <input class="border-b-2 border-b-zinc-200 dark:border-b-zinc-600 p-2" wire:model="tagName" placeholder="{{ __('Tag name') }}" />
        <button type="submit" ><flux:icon.plus /></button>
    </form>
    <div class="ml-auto">
        <flux:modal.trigger name="change-product-name.{{ $product->id }}">
            <flux:button icon="pencil"></flux:button>
        </flux:modal.trigger>
        <flux:button type="button" wire:click="deleteProduct()" wire:confirm="{{ __('Are you sure you want to delete this product?') }}" icon="trash" variant="danger" />
    </div>

    <flux:modal name="change-product-name.{{ $product->id }}" wire:listen="product-update">
        <div class="space-y-6">
            <flux:heading>{{ __('Update Product Name') }}</flux:heading>
        </div>
        <form wire:submit="updateProduct">
            <flux:input wire:model="newName" label="{{ __('New product name') }}" placeholder="{{ __('Product Name') }}"></flux:input>
            <flux:button type="submit" x-on:click="$flux.modals().close()">{{ __('Update') }}</flux:button>
        </form>
    </flux:modal>
</div>
