<div class="flex items-center gap-2">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <flux:field variant="inline">
        <flux:checkbox :checked="$product->is_completed" wire:click="checkProduct()" />
        <flux:label class="{{ $product->is_completed ? 'line-through' : '' }}">{{ $product->name }}</flux:label>
    </flux:field>
    @if ($product->tag->isNotEmpty())
        <ul class="flex gap-1">
            @foreach ($product->tag as $tag)
                <livewire:shopping-list.components.tag-list :tag="$tag" :key="$tag->id" />
            @endforeach
        </ul>
    @endif
    <div>
        <form wire:submit="createTag" class="flex flex-row gap-2">
            <input class="border-b-2 p-2" wire:model="tagName" placeholder="{{ __('Tag name') }}" />
            <button type="submit" ><flux:icon.plus /></button>
        </form>
    </div>
    <flux:button type="button" wire:click="deleteProduct()" icon="trash" variant="danger" />
</div>
