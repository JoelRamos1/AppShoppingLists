<div class="border rounded-lg dark:rounded-lg border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 px-4 py-2">
    {{-- Stop trying to control. --}}
    <div class="flex flex-row gap-2 items-center mb-2">
        <flux:heading size="lg" class="font-semibold dark:font-semibold">{{ $category->name }}</flux:heading>
        <flux:dropdown>
            <flux:button icon="bars-3" variant="ghost" />
            <flux:menu>
                <flux:modal.trigger name="change-name-category.{{ $category->id }}">
                    <flux:menu.item icon="pencil">{{ __('Edit category') }}</flux:menu.item>
                </flux:modal.trigger>
                <flux:menu.item icon="trash" variant="danger" wire:click="delete()"
                    wire:confirm="{{ __('Do you really want to delete this category') }}">{{ __('Delete category') }}
                </flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>
    <form wire:submit.prevent="newProduct" class="flex flex-row gap-2 mb-2">
        <flux:input wire:model="productName" placeholder="{{ __('Product') }}" />
        <flux:button icon="plus" variant="primary" type="submit">{{ __('Add product') }}</flux:button>
        <flux:error name="productName"></flux:error>
    </form>

    <div class="flex flex-col gap-2 mt-4">
        @forelse ($category->products as $product)
            <livewire:shopping-list.components.product-item :product="$product" :key="$product->id" lazy />
        @empty
            <flux:text class="py-2">{{ __('There are no products in this category. Create one above.') }}</flux:text>
        @endforelse
    </div>

    <flux:modal name="change-name-category.{{ $category->id }}" class="max-w-lg">
        <form wire:submit="changeCategoryName" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Change category name') }}</flux:heading>
            </div>

            <flux:input label="{{ __('New category name') }}" wire:model="newCategoryName" placeholder="{{ $category->name }}"></flux:input>
            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                    <flux:button variant="primary" type="submit">{{ __('Change name') }}</flux:button>
                </flux:modal.close>
            </div>
        </form>
    </flux:modal>
</div>
