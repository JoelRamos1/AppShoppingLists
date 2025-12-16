<div class="relative">
    @if (session()->has('success'))
        <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4">
            <flux:icon.check-circle variant="outline" /> {{ session('success') }}
        </div>
    @endif
    <div class="mb-4">
        <flux:heading size="xl" class="font-bold dark:font-bold">{{ __('My Shopping Lists') }}</flux:heading>
        <flux:subheading size="lg">{{__('See your created shopping lists')}}</flux:subheading>
    </div>
    <flux:separator variant="subtle" />
    <div class="mt-4 flex flex-row gap-2">
        <flux:input type="text" wire:model.live.debounce.500ms="search" wire:keydown.enter="reloadSearch()" placeholder="{{ __('Search through your shopping lists') }}" />
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
                    <flux:menu.radio value="asc">{{ __('Ascendent') }}</flux:menu.radio>
                    <flux:menu.radio value="desc">{{ __('Descendent') }}</flux:menu.radio>
                </flux:menu.radio>
            </flux:menu>
        </flux:dropdown>
    </div>
    <div class="flex flex-col gap-4 mt-4">
        @if (count($shoppingLists))
            @foreach ($shoppingLists as $shoppingList)
                <div wire:key="{{ $shoppingList->id }}"
                    class="grid grid-cols-2 items-center border-2 rounded-lg border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
                    <div>
                        <a href="{{ route('shopping-lists.show', $shoppingList->id) }}"
                            class="font-semibold">{{ $shoppingList->title }}</a>
                        <flux:text class="hidden lg:block">{{ __('Created ') }}{{ $shoppingList->created_at }} | {{ __('Last modified ') }}{{ $shoppingList->updated_at }}</flux:text>
                    </div>
                    <div class="flex justify-self-end gap-2">
                        <flux:button variant="ghost" icon="pencil"
                            href="{{ route('shopping-list.edit', $shoppingList->id) }}"></flux:button>
                        <livewire:shopping-list.components.share-menu :shoppingList="$shoppingList" :key="$shoppingList->id" lazy />
                        <flux:button variant="danger" color="red" icon="trash"
                            wire:click="delete({{ $shoppingList->id }})"
                            wire:confirm="{{ __('Are you sure you want to delete this shopping list?') }}">
                        </flux:button>
                    </div>
                </div>
            @endforeach
            <div>
                {{ $shoppingLists->links() }}
            </div>
        @else
            <flux:text>{{ __('You have not created any lists') }}</flux:text>
        @endif
    </div>
</div>
