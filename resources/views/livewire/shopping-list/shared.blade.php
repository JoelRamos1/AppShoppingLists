<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <flux:heading size="xl">{{ __('Shared Shopping Lists') }}</flux:heading>
    <div class="flex flex-col gap-4 mt-4">
            @if (count($shoppingLists))
                @foreach ($shoppingLists as $shoppingList)
                    <div wire:key="{{ $shoppingList->id }}"
                        class="grid grid-cols-2 items-center border-2 border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
                        <div>
                            <a href="{{ route('shopping-lists.show', $shoppingList->id) }}"
                                class="font-semibold">{{ $shoppingList->title }}</a>
                            <flux:text>{{ __('Created ') }}{{$shoppingList->created_at }}</flux:text>
                        </div>
                        <div class="flex justify-self-end gap-2">
                            <flux:button variant="ghost" icon="pencil"
                                href="{{ route('shopping-list.edit', $shoppingList->id) }}"></flux:button>
                        </div>
                    </div>
                @endforeach
            @else
                <flux:text>{{ __('You have not created any lists') }}</flux:text>
            @endif
        </div>
</div>
