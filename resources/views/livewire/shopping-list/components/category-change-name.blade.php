<div>
    <flux:modal.trigger name="change-name-category.{{ $category->id }}">
        <flux:button icon="pencil"></flux:button>
    </flux:modal.trigger>

    <flux:modal name="change-name-category.{{ $category->id }}">
        <div class="space-y-6">

        </div>
        <form wire:submit="changeCategoryName">
            <flux:input label="New name" wire:model="newCategoryName" placeholder="Category Name"></flux:input>
            <flux:button type="submit">Update</flux:button>
        </form>
    </flux:modal>
</div>
