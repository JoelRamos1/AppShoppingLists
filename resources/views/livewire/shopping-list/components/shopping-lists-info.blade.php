<div class="relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700 p-4">
    {{-- Success is as dangerous as failure. --}}
    <flux:heading size="xl" class="font-bold mb-2">Recent Shopping Lists</flux:heading>
    <div class="">
        @if(count($shoppingLists))
            <ul class="grid grid-rows-5 gap-1">
                @foreach ($shoppingLists as $shoppingList)
                    <li><a class="block border rounded-2xl p-2" href="{{route('shopping-lists.show', $shoppingList->id)}}">{{$shoppingList->title}}</a></li>
                @endforeach
            </ul>
        @else
            <flux:text>{{__('You havent created any lists')}}</flux:text>
        @endif
    </div>
</div>
