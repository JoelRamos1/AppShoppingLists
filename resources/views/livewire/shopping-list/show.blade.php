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
    <div class="flex flex-row gap-2">
        <flux:heading size="xl" class="mr-2">{{ $shopping_list->title }}</flux:heading>
        <flux:dropdown>
            <flux:button icon="cog-8-tooth" icon:variant="outline"></flux:button>
            <flux:menu>
                <flux:menu.item icon="pencil" href="{{route('shopping-list.edit', $shopping_list->id)}}">Edit Post
                </flux:menu.item>
                <flux:menu.item icon="trash" variant="danger">Delete Post</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </div>

    {{-- Create category form --}}
    <form wire:submit="save" class="flex flex-row gap-2 my-4">
        <flux:input wire:model="name" placeholder="{{ __('Name of the category') }}" />
        <flux:button variant="primary" icon="plus" type="submit">
            {{ __('Add Category') }}
        </flux:button>
    </form>

    <flux:separator />

    {{-- Categories --}}
    <div class="mt-4">
        @forelse ($shopping_list->categories as $category)
            <div>
                <div class="grid grid-cols-2 items-center justify-start mb-2">
                    <flux:heading size="lg">{{ $category->name }}</flux:heading>
                    <flux:button class="justify-self-end" variant="danger" icon="trash"
                        wire:click="delete({{ $category->id }})" type="button" />
                </div>

                <livewire:shopping-list.category-editor :category="$category" :key="'category-' . $category->id" lazy />
                <flux:separator class="my-2"></flux:separator>
            </div>
        @empty
            <flux:text>{{ __('There are no categories in this shopping list. Create one above.') }}</flux:text>
        @endforelse
    </div>
</div>
