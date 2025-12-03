<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <flux:modal.trigger name="share-shopping-list.{{ $shoppingList->id }}">
        <flux:button variant="ghost" icon="share"></flux:button>
    </flux:modal.trigger>
    <flux:modal name="share-shopping-list.{{ $shoppingList->id }}">
        @if(session()->has('success'))
        <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4" x-data="{ show: true }"
            x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <flux:icon.check-circle variant="outline" /> {{ session('success') }}
        </div>
        @endif
        <div>
            <flux:heading>{{ __('Share')." ".$shoppingList->title}}</flux:heading>
            <flux:text>{{ __('Share this shopping list with another user')}}</flux:text>
        </div>

        <form wire:submit="invite" class="mt-4 flex flex-col gap-4">
                <flux:input type="email" wire:model="userEmail" label="{{ __('User Email') }}" />

                <flux:select wire:model="role" label="{{ __('Role') }}" placeholder="{{ __('Role') }}">
                    <flux:select.option value="editor">{{ __('Editor') }}</flux:select.option>
                </flux:select>
                <flux:button variant="primary" type="submit">{{ __('Share') }}</flux:button>
            </form>
    </flux:modal>
</div>
