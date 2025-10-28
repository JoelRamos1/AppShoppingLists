<div>
    <div>
        <flux:heading size="xl">{{__('New Shopping List')}}</flux:heading>
        <div class="mt-4">
            <form wire:submit="save" class="flex flex-col gap-4">
                <flux:field>
                    <flux:label>{{__('Title')}}</flux:label>
                    <flux:description>{{__('This will be the name of your shopping list')}}</flux:description>
                    <flux:input wire:model="title"></flux:input>
                    <flux:error name="title"></flux:error>
                </flux:field>
                <flux:button variant="primary" icon="plus" type="submit">{{__('Create')}}</flux:button>
            </form>
        </div>
    </div>
</div>
