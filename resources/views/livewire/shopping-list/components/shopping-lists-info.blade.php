<div class="relative aspect-video p-4 rounded-xl border border-neutral-200 dark:border-zinc-700 p-4">
    {{-- Success is as dangerous as failure. --}}
    <flux:heading size="lg" class="font-bold mb-2">Recent Shopping Lists</flux:heading>
    <div class="mt-2">
        @if(count($shoppingLists))
            <ul class="grid grid-rows-5 gap-2">
                @foreach ($shoppingLists as $shoppingList)
                    <li><a class="block border border-neutral-200 dark:border-zinc-600 p-2" href="{{route('shopping-lists.show', $shoppingList->id)}}">{{$shoppingList->title}}</a></li>
                @endforeach
            </ul>
        @else
            <flux:text>{{__('You havent created any lists')}}</flux:text>
        @endif
    </div>
</div>
