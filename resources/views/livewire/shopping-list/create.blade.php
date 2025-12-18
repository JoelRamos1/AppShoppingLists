<div class="w-full">
    <div>
        <div>
            <flux:heading size="xl" class="font-bold dark:font-bold">{{__('New Shopping List')}}</flux:heading>
            <flux:subheading size="lg" class="mb-4">{{ __('Create a new shopping list') }}</flux:subheading>
        </div>
        <flux:separator variant="subtle" />
        <div class="mt-4">
            <form wire:submit="save" class="flex flex-col gap-4">
                <flux:field>
                    <flux:label>{{__('Title of the shopping list')}}</flux:label>
                    <flux:input wire:model="title" placeholder="{{ __('Groceries, weekend shopping, food...') }}"></flux:input>
                    <flux:error name="title"></flux:error>
                </flux:field>
                <flux:button variant="primary" icon="plus" type="submit">{{__('Create')}}</flux:button>
            </form>
        </div>
    </div>
</div>
