<x-layouts.app :title="__('Dashboard')">
    {{-- <livewire:test> --}}

    <div class="flex flex-1 flex-col h-full w-full gap-4 rounded-xl">
        {{-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <livewire:shopping-list.components.shopping-lists-info />
            </div>
            <div class="flex flex-col text-center p-4 gap-4 justify-center relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700">
                <flux:text>{{ __('Create a shopping list!') }}</flux:text>
                <flux:button variant="primary" icon="plus" href="{{ route('shopping-lists.create') }}">{{ __('Create list') }}</flux:button>
            </div>
            <livewire:shopping-list.components.shopping-lists-info />


            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div> --}}
        <div class="flex flex-col min-md:hidden">
            <flux:button icon="plus" variant="primary" href="{{ route('shopping-lists.create') }}">
                {{ __('Create a new shopping list') }}</flux:button>
        </div>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4">
            <livewire:shopping-list.partials.recent-lists />
            <livewire:shopping-list.partials.shared-lists />
        </div>
    </div>
</x-layouts.app>
