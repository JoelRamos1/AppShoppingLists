<div class="w-full">
    @if (session()->has('success'))
        <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4">
            <flux:icon.check-circle variant="outline" /> {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <flux:heading size="xl" class="font-bold dark:font-bold">{{ __('Shopping lists') }}</flux:heading>
    </div>
    <flux:separator variant="subtle" />
    <div class="mt-4 flex flex-row gap-2">
        <flux:input type="text" wire:model.live.debounce.500ms="search" wire:keydown.enter="reloadSearch()"
            placeholder="{{ __('Search for a shopping list') }}" />
        <flux:dropdown>
            <flux:button icon:trailing="adjustments-vertical">{{ __('Sort') }}</flux:button>

            <flux:menu>
                <flux:menu.radio.group wire:model.live="sortBy">
                    <flux:menu.radio value="created_at">{{ __('Created') }}</flux:menu.radio>
                    <flux:menu.radio value="updated_at">{{ __('Updated') }}</flux:menu.radio>
                    <flux:menu.radio value="title">{{ __('Title') }}</flux:menu.radio>
                </flux:menu.radio.group>
                <flux:menu.separator />
                <flux:menu.radio.group wire:model.live="sortDirection">
                    <flux:menu.radio value="asc">{{ __('Ascendant') }}</flux:menu.radio>
                    <flux:menu.radio value="desc">{{ __('Descendent') }}</flux:menu.radio>
                    </flux:menu.radio>
            </flux:menu>
        </flux:dropdown>
    </div>
    <div class="flex flex-col gap-4 mt-4">
        @if (count($shoppingLists))
            @foreach ($shoppingLists as $shoppingList)
                <livewire:shopping-list.components.shopping-list-item :shoppingList="$shoppingList" :key="$shoppingList->id" />
            @endforeach
            <div>
                {{ $shoppingLists->links() }}
            </div>
        @else
            <flux:text>{{ __('You have not created any shopping lists.') }}</flux:text>
        @endif
    </div>
</div>
