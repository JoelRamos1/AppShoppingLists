<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <li class="flex h-full opacity-80 p-1 items-center justify-center">
        <flux:text class="text-blue-400">{{ '#' . $tag->name }}</flux:text>
        <flux:button class="text-blue-400" type="button" variant="ghost" size="sm" icon="x-mark" wire:click="deleteTag()"></flux:button>
    </li>
</div>
