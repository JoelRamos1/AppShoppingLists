<div>
    <div>
        @if (session()->has('success'))
            <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4">
                <flux:icon.check-circle variant="outline"/> {{session('success')}}
            </div>
        @endif
        <flux:heading size="xl">{{ __('My Shopping Lists')}}</flux:heading>
        <div class="flex flex-col gap-4 mt-4">
            @if (count($shopping_lists))
                @foreach ($shopping_lists as $shop_list)
                    <div class="grid grid-cols-2 items-center border-2 border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
                        <div>
                            <a href="{{route('shopping-lists.show', $shop_list->id)}}" class="font-semibold">{{$shop_list->title}}</a>
                            <flux:text>{{__('Created ')}}{{$shop_list->created_at}}</flux:text>
                        </div>
                        <div class="flex justify-self-end gap-2">
                            <flux:button variant="filled" icon="share" wire:click="share"></flux:button>
                            <flux:button variant="danger" color="red" icon="trash" wire:click="delete({{$shop_list->id}})" wire:confirm="{{__('Are you sure you want to delete this shopping list?')}}"></flux:button>
                        </div>
                    </div>
                @endforeach
            @else
                <flux:text>{{ __('You have not created any lists') }}</flux:text>
            @endif
        </div>
    </div>
</div>
