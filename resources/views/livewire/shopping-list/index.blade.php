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
        <flux:input type="text" wire:model.live.debounce.500ms="search" wire:keydown.enter="updatingSearch()" placeholder="{{ __('Search through your shopping lists') }}" />
        <flux:dropdown>
            <flux:button icon:trailing="chevron-down">Sort by</flux:button>

            <flux:menu>
                <flux:menu.radio.group wire:model="sortBy">
                    <flux:menu.radio checked>Date Created</flux:menu.radio>
                    <flux:menu.radio>Latest Activity</flux:menu.radio>
                </flux:menu.radio.group>
            </flux:menu>
        </flux:dropdown>
    </div>
    <div class="flex flex-col gap-4 mt-4">
        @if (count($shoppingLists))
            @foreach ($shoppingLists as $shoppingList)
                <div wire:key="{{ $shoppingList->id }}"
                    class="grid grid-cols-2 items-center border-2 border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
                    <div>
                        <a href="{{ route('shopping-lists.show', $shoppingList->id) }}"
                            class="font-semibold">{{ $shoppingList->title }}</a>
                        <flux:text>{{ __('Created ') }}{{ $shoppingList->created_at }} | {{ __('Last modified ') }}{{ $shoppingList->updated_at }}</flux:text>
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
