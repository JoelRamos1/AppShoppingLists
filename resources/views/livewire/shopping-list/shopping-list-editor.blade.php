<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        <flux:heading size="xl">{{ __('Editing Shopping List ').$shoppingList->title }}</flux:heading>
    </div>

    <div>
        <div>
            <flux:heading size="lg">{{ __('Basic Information')}}</flux:heading>
            <form wire:submit="updateTitle">
                <flux:input
                    label="{{__('Update Title')}}"
                    placeholder="{{$shoppingList->title}}"
                    wire:model="newTitle"
                />
                <flux:button variant="primary" icon="arrow-path" type="submit">{{ __('Update Title')}}</flux:button>
            </form>
        </div>
        <div>
            <flux:heading size="lg">{{ __('Share this Shopping List')}}</flux:heading>
            <flux:text>{{ __('Share this shopping list with another user')}}</flux:text>
        </div>

        <form wire:submit="invite" class="flex flex-col gap-4">
            <flux:input
                wire:model="userEmail"
                label="{{ __('User Email')}}"
            />
            <flux:select wire:model="role" label="{{ __('Role')}}" placeholder="{{ __('Role') }}">
                <flux:select.option value="editor">{{ __('Editor')}}</flux:select.option>
            </flux:select>
            <flux:button variant="primary" type="submit">{{ __('Share')}}</flux:button>
        </form>
    </div>
</div>
