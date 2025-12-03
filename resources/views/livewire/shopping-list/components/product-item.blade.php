<div class="flex flex-row gap-2">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <flux:field variant="inline">
        <flux:checkbox :checked="$product->is_completed" wire:click="checkProduct()" />
        <flux:label>{{ $product->name }}</flux:label>
    </flux:field>
    @if ($product->tag->isNotEmpty())
        <ul class="flex gap-1">
            @foreach ($product->tag as $tag)
                <livewire:shopping-list.components.tag-list :tag="$tag" :key="$tag->id"/>
            @endforeach
        </ul>
    @endif
    <flux:modal.trigger name="add-tag.{{ $product->id }}">
        <flux:button icon="plus"></flux:button>
    </flux:modal.trigger>
    <flux:button type="button" wire:click="deleteProduct()" icon="trash" variant="danger" />
    <flux:modal name="add-tag.{{ $product->id }}">
        <div>
            <div>
                <flux:heading>{{ __('Tag') }}{{ $product->name }}</flux:heading>
            </div>
            <form wire:submit="createTag">
                <flux:input type="text" wire:model="tagName" />
                <flux:button icon="plus" type="submit" />
            </form>
        </div>
    </flux:modal>
</div>
