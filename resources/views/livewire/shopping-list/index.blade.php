<div>
    <div>
        @if (session()->has('success'))
            <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4">
                <flux:icon.check-circle variant="outline" /> {{ session('success') }}
            </div>
        @endif
        <flux:heading size="xl">{{ __('My Shopping Lists') }}</flux:heading>
        <div class="flex flex-col gap-4 mt-4">
            @if (count($shoppingLists))
                @foreach ($shoppingLists as $shoppingList)
                    <div wire:key="{{ $shoppingList->id }}"
                        class="grid grid-cols-2 items-center border-2 border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
                        <div>
                            <a href="{{ route('shopping-lists.show', $shoppingList->id) }}"
                                class="font-semibold">{{ $shoppingList->title }}</a>
                            <flux:text>{{ __('Created') }}{{ $shoppingList->created_at }}</flux:text>
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
</div>
