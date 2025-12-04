<div>
    {{-- Do your work, then step back. --}}

    {{-- Success message --}}
    @if (session()->has('success'))
        <div class="bg-green-500 text-white font-semibold flex flex-row gap-2 px-2 py-4" x-data="{ show: true }"
            x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <flux:icon.check-circle variant="outline" /> {{ session('success') }}
        </div>
    @endif

    {{-- Title --}}
    <div class="flex flex-row items-center gap-2 mb-4">
        <flux:heading size="xl" class="font-bold dark:font-bold">{{ $shopping_list->title }}</flux:heading>
        <flux:dropdown>
            <flux:button icon="cog-8-tooth" variant="ghost" icon:variant="outline"></flux:button>
            <flux:menu>
                <flux:menu.item icon="pencil" href="{{route('shopping-list.edit', $shopping_list->id)}}">Edit Post</flux:menu.item>
                <flux:menu.item icon="trash" variant="danger" wire:click="deleteShoppingList" wire:confirm="{{__('Are you sure you want to delete this list')}}">Delete Post</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>

    <flux:separator variant="subtle" />

    {{-- Create category form --}}
    <form wire:submit="save" class="flex flex-row gap-2 my-4">
        <flux:input wire:model="name" placeholder="{{ __('Name of the category') }}" />
        <flux:button variant="primary" icon="plus" type="submit">
            {{ __('Add Category') }}
        </flux:button>
    </form>

    {{-- Categories --}}
    <div class="flex flex-col gap-4 mt-4">
        @forelse ($shopping_list->categories as $category)
            <livewire:shopping-list.category-editor :category="$category" :key="'category-' . $category->id" lazy />
        @empty
            <flux:text>{{ __('There are no categories in this shopping list. Create one above.') }}</flux:text>
        @endforelse
    </div>
</div>
