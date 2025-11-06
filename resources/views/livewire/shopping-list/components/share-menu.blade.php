<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <flux:modal.trigger name="share-shopping-list">
        <flux:button variant="ghost" icon="share"></flux:button>
    </flux:modal.trigger>
    <flux:modal name="share-shopping-list">
        <form wire:submit="invite">
            <flux:input></flux:input>

            <flux:button type="submit"></flux:button>
        </form>
    </flux:modal>
</div>
