<div class="w-full">
    <div
        class="flex flex-row items-center justify-between border-2 rounded-lg border-zinc-200 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white px-4 py-4">
        <div>
            <a href="{{ route('shopping-lists.show', $shoppingList->id) }}"
                class="font-semibold">{{ $shoppingList->title }}</a>
            <flux:text class="max-xl:hidden">{{ __('Created ') }}{{ $shoppingList->created_at }} |
                {{ __('Last modified ') }}{{ $shoppingList->updated_at }}</flux:text>
        </div>
        <div class="flex gap-2 items-center">
            <flux:text>{{ $completedProducts . "/" . $totalProducts }}</flux:text>
            <flux:button.group class="max-md:hidden">
                <flux:button variant="filled" icon="pencil" href="{{ route('shopping-list.edit', $shoppingList->id) }}">
                </flux:button>
                @if($shoppingList->owner_id == Auth::id())
                <flux:modal.trigger name="share-shopping-list.{{ $shoppingList->id }}">
                    <flux:button icon="share" variant="filled"></flux:button>
                </flux:modal.trigger>
                <flux:button variant="danger" color="red" icon="trash" wire:click="delete({{ $shoppingList->id }})"
                    wire:confirm="{{ __('Are you sure you want to delete this shopping list?') }}">
                </flux:button>
                @endif
            </flux:button.group>
            <flux:dropdown class="min-md:hidden">
                <flux:button variant="filled" icon="ellipsis-horizontal"></flux:button>
                <flux:menu>
                    <flux:menu.item icon="pencil" href="{{ route('shopping-list.edit', $shoppingList->id) }}">{{ __('Edit') }}</flux:menu.item>
                    @if($shoppingList->owner_id == Auth::id())
                    <flux:modal.trigger name="share-shopping-list.{{ $shoppingList->id }}">
                        <flux:menu.item icon="share">{{ __('Share') }}</flux:menu.item>
                    </flux:modal.trigger>
                    <flux:menu.item variant="danger" icon="trash" wire:click="delete({{ $shoppingList->id }})"
                    wire:confirm="{{ __('Are you sure you want to delete this shopping list?') }}">{{ __('Delete') }}
                    </flux:menu.item>
                    @endif
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    <flux:modal name="share-shopping-list.{{ $shoppingList->id }}">
        @if (session()->has('success'))
            <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4" x-data="{ show: true }"
                x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <flux:icon.check-circle variant="outline" /> {{ session('success') }}
            </div>
        @endif
        <div>
            <flux:heading>{{ __('Share') . ' ' . $shoppingList->title }}</flux:heading>
            <flux:text>{{ __('Share this shopping list with another user') }}</flux:text>
        </div>

        <form wire:submit="invite" class="mt-4 flex flex-col gap-4">
            <flux:input type="email" wire:model="userEmail" label="{{ __('User Email') }}" />

            <flux:select wire:model="role" label="{{ __('Role') }}" placeholder="{{ __('Role') }}">
                <flux:select.option value="editor">{{ __('Editor') }}</flux:select.option>
            </flux:select>
            <flux:button variant="primary" type="submit">{{ __('Share') }}</flux:button>
        </form>
    </flux:modal>
</div>
