<div class="w-full">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="flex flex-row items-center justify-between gap-2">
        <div class="flex flex-row items-center gap-4">
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
        </div>
        <div>
            <flux:button.group class="max-sm:hidden">
                <flux:modal.trigger name="add-tag.{{ $product->id }}">
                    <flux:button icon="plus" variant="primary"></flux:button>
                </flux:modal.trigger>
                <flux:modal.trigger name="change-product-name.{{ $product->id }}">
                    <flux:button icon="pencil"></flux:button>
                </flux:modal.trigger>
                <flux:button type="button" wire:click="deleteProduct()" wire:confirm="{{ __('Are you sure you want to delete this product?') }}" icon="trash" variant="danger" />
            </flux:button.group>
            <flux:dropdown class="min-md:hidden">
                <flux:button variant="ghost" icon="ellipsis-horizontal"></flux:button>
                <flux:menu>
                    <flux:modal.trigger name="add-tag.{{ $product->id }}">
                        <flux:menu.item icon="plus">{{ __('Add tag') }}</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:modal.trigger name="change-product-name.{{ $product->id }}">
                        <flux:menu.item icon="pencil">{{ __('Change product name') }}</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:menu.item icon="trash" variant="danger" wire:click="deleteProduct()" wire:confirm="{{ __('Are you sure you want to delete this product?') }}">{{ __('Delete product') }}</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    <flux:modal name="change-product-name.{{ $product->id }}" wire:listen="product-update" class="max-w-lg">
        <form wire:submit="updateProduct" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Update Product Name') }}</flux:heading>
            </div>
            <flux:input wire:model="newName" label="{{ __('New product name') }}" placeholder="{{ $product->name }}"></flux:input>
            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button variant="primary" type="submit" x-on:click="$flux.modals().close()">{{ __('Update') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <flux:modal name="add-tag.{{ $product->id }}" class="max-w-lg">
        <form wire:submit.prevent="createTag" class="flex flex-col space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Add tag') }}</flux:heading>
                <flux:subheading>{{ __('Add tags to your products') }}</flux:subheading>
            </div>
            <input class="w-fit border-2 rounded-lg border-b-zinc-200 dark:border-b-zinc-600 p-2" wire:model="tagName" placeholder="{{ __('Tag name') }}" />
            <button type="submit" class="flex flex-row text-white justify-center bg-accent rounded-lg p-2" ><flux:icon.plus class="size-6" />{{ __('Add tag') }}</button>
        </form>
    </flux:modal>
</div>
