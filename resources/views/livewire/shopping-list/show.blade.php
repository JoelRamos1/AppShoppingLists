<div>
    {{-- Do your work, then step back. --}}
    <div class="flex flex-row gap-2">
        <flux:heading size="xl">{{ $shopping_list->title }}</flux:heading>
        <flux:modal.trigger name="edit-shopping-list">
            <flux:button icon="pencil-square"></flux:button>
        </flux:modal.trigger>
        <flux:button variant="danger" icon="trash" wire:click="deleteShoppingList"/>
    </div>

    <form wire:submit="save" class="flex flex-row gap-2 my-4">
        <flux:input wire:model="name" placeholder="{{ __('Name of the category') }}" />
        <flux:button variant="primary" icon="plus" type="submit">
            {{ __('Add Category') }}
        </flux:button>
    </form>

    <flux:separator />

    <div class="mt-4">
        @forelse ($shopping_list->categories as $category)
            <div>
                <div class="grid grid-cols-2 items-center">
                    <flux:heading size="lg">{{ $category->name }}</flux:heading>
                    <flux:button class="justify-self-end"
                                 variant="danger"
                                 icon="trash"
                                 wire:click="delete({{ $category->id }})"
                                 type="button"/>
                </div>

                <livewire:shopping-list.category-editor
                    :category="$category"
                    :key="'category-'.$category->id"/>
            </div>
        @empty
            <flux:text>{{ __('There are no categories in this shopping list. Create one above.') }}</flux:text>
        @endforelse
    </div>
    <flux:modal name="edit-shopping-list">
        <div>
            <div>
                <flux:heading>{{ __('Edit Shopping List') }}</flux:heading>
            </div>
            <form wire:sumbit="updateTitle">
                <flux:input
                    wire:model="newTitle"
                    label="{{ __('New Title') }}"
                />
                <flux:button type="submit" icon="arrow-path" variant="primary">{{ __('Update Shopping List')}}</flux:button>
            </form>
        </div>
    </flux:modal>
</div>
