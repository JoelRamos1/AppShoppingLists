<div class="relative">
    <div>
        <div>
            <flux:heading size="xl" class="font-bold dark:font-bold">{{__('New Shopping List')}}</flux:heading>
            <flux:subheading size="lg" class="mb-4">{{ __('Create a new shopping list') }}</flux:subheading>
        </div>
        <flux:separator variant="subtle" />
        <div class="mt-4">
            <form wire:submit="save" class="flex flex-col gap-4">
                <flux:field>
                    <flux:label>{{__('Title')}}</flux:label>
                    <flux:description>{{__('This will be the title of your shopping list')}}</flux:description>
                    <flux:input wire:model="title" placeholder="{{ __('Morning buy, emergency food, etc') }}"></flux:input>
                    <flux:error name="title"></flux:error>
                </flux:field>
                <flux:button variant="primary" icon="plus" type="submit">{{__('Create')}}</flux:button>
            </form>
        </div>
    </div>
</div>
