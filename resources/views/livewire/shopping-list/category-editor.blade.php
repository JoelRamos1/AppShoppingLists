<div class="border rounded-xs px-4 py-2">
    {{-- Stop trying to control. --}}
    <div class="flex flex-row gap-2 items-center mb-2">
        <flux:heading size="lg" class="font-bold dark:font-bold">{{ $category->name }}</flux:heading>
        <flux:dropdown>
            <flux:button icon="bars-3" variant="ghost" />
            <flux:menu>
                <flux:menu.item icon="pencil">{{ __('Change Name of Category') }}</flux:menu.item>
                <flux:menu.item icon="trash" variant="danger" wire:click="delete()"
                    wire:confirm="{{ __('Do you really want to delete this category') }}">{{ __('Delete Category') }}
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>
    <form wire:submit.prevent="newProduct" class="flex flex-row gap-2 mb-2">
        <flux:input wire:model="name" placeholder="{{ __('New Product') }}" />
        <flux:button icon="plus" variant="primary" type="submit" />
    </form>
    @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror

    <div class="flex flex-col gap-2">
        @forelse ($category->products as $product)
            <livewire:shopping-list.components.product-item :product="$product" :key="$product->id" lazy />
        @empty
            <flux:text>{{ __('There are no products in this category. Create one above.') }}</flux:text>
        @endforelse
    </div>
</div>
