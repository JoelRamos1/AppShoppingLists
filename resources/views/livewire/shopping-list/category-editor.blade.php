<div>
    {{-- Stop trying to control. --}}
    <form wire:submit.prevent="newProduct" class="flex flex-row gap-2 mb-2">
        <flux:input wire:model="name" placeholder="{{ __('New Product') }}" />
        <flux:button icon="plus" variant="ghost" type="submit" />
    </form>
    @error('name')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror

    <div class="flex flex-col gap-2">
        @forelse ($category->products as $product)
            <livewire:shopping-list.components.product-item :product="$product" :key="$product->id" lazy/>
        @empty
            <flux:text>{{ __('There are no products in this category. Create one above.') }}</flux:text>
        @endforelse
    </div>
</div>
