<div>
    {{-- The Master doesn't talk, he acts. --}}
    <flux:modal.trigger name="edit-shopping-list">
        <flux:button icon="pencil-square"></flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-shopping-list">
        <div>
            <div>
                <flux:heading>{{ __('Edit Shopping List') }}</flux:heading>
            </div>
            <form wire:sumbit="updateTitle{{ $shopping_list->id }}">
                <flux:input
                    wire:model="newTitle"
                    label="{{ __('New Title') }}"
                />
                <flux:button type="submit" icon="arrow-path" variant="primary">{{ __('Update Shopping List')}}</flux:button>
            </form>
        </div>
    </flux:modal>
</div>
