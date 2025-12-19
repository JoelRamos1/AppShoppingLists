<div class="w-full flex-1/2 border rounded-lg border-zinc-200 dark:border-zinc-700 dark:text-white p-4">
    {{-- In work, do what you enjoy. --}}
    <flux:heading size="xl" class="font-semibold dark:semibold">{{ __('Recently Shared') }}</flux:heading>
    <div class="flex flex-col gap-4 mt-4">
        @forelse ($shoppingLists as $shoppingList)
            <livewire:shopping-list.components.shopping-list-item :shoppingList="$shoppingList" />
        @empty
            <flux:text>{{ __('You do not have any shared shopping lists.') }}</flux:text>
        @endforelse
    </div>
</div>
