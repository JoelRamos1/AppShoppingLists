<div class="relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
    {{-- Success is as dangerous as failure. --}}
    <flux:heading size="xl" class="font-bold">Recent Shopping Lists</flux:heading>
    <div>
        @forelse ($shoppingLists as $shoppingList)
            <a href="{{route('shopping-lists.show', $shoppingList->id)}}">{{$shoppingList->title}}</a>
        @empty

        @endforelse
    </div>
</div>
