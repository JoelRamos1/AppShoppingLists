<div class="w-full flex-1/2 border rounded-lg border-zinc-200 dark:border-zinc-700 dark:text-white p-4">
    {{-- The Master doesn't talk, he acts. --}}
    <flux:heading size="xl" class="font-semibold dark:font-semibold">{{ __('Recent Shopping Lists') }}</flux:heading>
    <div class="flex flex-col gap-4 mt-4">
        @forelse ($shoppingLists as $shoppingList)
            <livewire:shopping-list.components.shopping-list-item :shoppingList="$shoppingList" />
        @empty
            <flux:text>{{ __('You have not created any shopping lists.') }}</flux:text>
        @endforelse
    </div>
</div>
