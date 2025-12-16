<div>
    <flux:modal.trigger name="change-name-category.{{ $category->id }}">
        <flux:button variant="ghost" icon="pencil"></flux:button>
    </flux:modal.trigger>

    <flux:modal name="change-name-category.{{ $category->id }}" class="max-w-lg">
        <form wire:submit="changeCategoryName" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Update category name') }}</flux:heading>
                <flux:subheading>
                    {{ __('Update the name for this category') }}
                </flux:subheading>
            </div>

            <flux:input label="{{ __('New category name') }}" wire:model="newCategoryName" placeholder="{{ $category->name }}"></flux:input>
            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancel') }}</flux:button>
                    <flux:button variant="primary" type="submit">Update</flux:button>
                </flux:modal.close>
            </div>
        </form>
    </flux:modal>
</div>
