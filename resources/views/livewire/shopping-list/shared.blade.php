<div class="w-full">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div>
        <flux:heading size="xl" class="font-bold dark:font-bold">{{ __('Shared Shopping Lists') }}</flux:heading>
        <flux:subheading size="lg" class="mb-4">{{ __('View the shopping lists that other users have shared with you.') }}</flux:subheading>
    </div>
    <flux:separator variant="subtle" />
    <div class="mt-4 flex flex-row gap-2">
        <flux:input type="text" wire:model.live.debounce.500ms="search" wire:keydown.enter="updatingSearch()" placeholder="{{ __('Search for a shopping list') }}" />
    </div>
    <div class="flex flex-col gap-4 mt-4">
            @if (count($shoppingLists))
                @foreach ($shoppingLists as $shoppingList)
                    <div wire:key="{{ $shoppingList->id }}"
                        class="grid grid-cols-2 items-center border-2 border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
                        <div>
                            <a href="{{ route('shopping-lists.show', $shoppingList->id) }}"
                                class="font-semibold">{{ $shoppingList->title }}</a>
                            <flux:text>{{ __('Created by ') }}{{$shoppingList->owner->name}}</flux:text>
                        </div>
                        <div class="flex justify-self-end gap-2">
                            <flux:button variant="ghost" icon="pencil"
                                href="{{ route('shopping-list.edit', $shoppingList->id) }}"></flux:button>
                        </div>
                    </div>
                @endforeach
            @else
                <flux:text>{{ __('You do not have any shared shopping lists.') }}</flux:text>
            @endif
        </div>
</div>
