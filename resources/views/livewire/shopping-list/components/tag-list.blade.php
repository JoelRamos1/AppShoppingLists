<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <li class="flex bg-blue-600 rounded-xl p-1 items-center">
        {{ '#' . $tag->name }}
        <button class="flex items-center" wire:click="deleteTag()" type="button">
            <flux:icon.x-mark class="size-4"></flux:icon.x-mark>
        </button>
    </li>
</div>
