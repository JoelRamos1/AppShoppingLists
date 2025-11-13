<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <flux:modal.trigger name="share-shopping-list">
        <flux:button variant="ghost" icon="share"></flux:button>
    </flux:modal.trigger>
    <flux:modal name="share-shopping-list">
        <div>
            <flux:heading>{{ __('Share this Shopping List')}}</flux:heading>
            <flux:text>{{ __('Share this shopping list with another user')}}</flux:text>
        </div>

        <form wire:submit="invite" class="flex flex-col gap-4">
            <flux:input
                wire:model="userEmail"
                label="{{ __('User Email')}}"
            />
            <flux:select wire:model="role" label="{{ __('Role')}}" placeholder="{{ __('Role') }}" clearable>
                <flux:select.option value="editor">{{ __('Editor')}}</flux:select.option>
            </flux:select>
            <flux:button variant="primary" type="submit">{{ __('Share')}}</flux:button>
        </form>
    </flux:modal>
</div>
