<div class="w-full">
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        <flux:heading size="xl" level="1" class="font-bold dark:font-bold">
            {{ __('Edit Shopping List ') . '"' . $shoppingList->title . '"' }}</flux:heading>
        <flux:subheading size="lg" class="mb-4">{{ __('Edit or share this shopping list') }}</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <div class="my-4">
        <flux:heading size="lg" class="font-semibold dark:font-semibold">{{ __('Information') }}</flux:heading>
        <form wire:submit="updateTitle" class="mt-2 flex flex-col gap-4">
            <div>
                <flux:heading>{{ __('Change shopping list name') }}</flux:heading>
            </div>
            <flux:input type="text" label="{{ __('Change Title') }}" placeholder="{{ $shoppingList->title }}"
                wire:model="newTitle" clearable>
            </flux:input>
            <flux:button variant="primary" icon="arrow-path" type="submit">{{ __('Update Title') }}</flux:button>
            <flux:error name="newTitle"></flux:error>
        </form>
    </div>
    <flux:separator variant="subtle" />
    <div class="my-4">
        <div class="mb-4">
            <flux:heading size="lg" class="font-semibold dark:font-semibold">{{ __('Share') }}</flux:heading>
        </div>
        <div class="mb-4">
            <flux:heading>{{ __('Status') }}</flux:heading>
            <div class="flex flex-col gap-2">
                @if ($shoppingList->is_shared)
                    <flux:text>{{ __('Your shopping list is currently visible to other users.') }}</flux:text>
                    <flux:button variant="danger" wire:click="shareList()">{{ __('Stop sharing this list') }}
                    </flux:button>
                @else
                    <flux:text>{{ __('Your shopping list is currently only visible to you.') }}</flux:text>
                    <flux:button variant="primary" icon="share" wire:click="shareList()">{{ __('Share list') }}
                    </flux:button>
                @endif
            </div>
        </div>
        <div>
            <flux:heading size="lg">{{ __('Members') }}</flux:heading>
            @if ($shoppingList->is_shared)

                <table class="border-collapse border border-zinc-200 dark:border-zinc-700 mt-4">
                    <thead>
                        <tr>
                            <th class="border border-zinc-200 dark:border-zinc-700 py-2 px-4">{{ __('Name') }}</th>
                            <th class="border border-zinc-200 dark:border-zinc-700 py-2 px-4">{{ __('Email') }}</th>
                            <th class="border border-zinc-200 dark:border-zinc-700 py-2 px-4">{{ __('Role') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shoppingList->members as $member)
                            <tr wire:key="{{ $member->id }}">
                                <td class="border border-zinc-200 dark:border-zinc-700 py-2 px-4">{{ $member->name }}
                                </td>
                                <td class="border border-zinc-200 dark:border-zinc-700 py-2 px-4">{{ $member->email }}
                                </td>
                                <td class="capitalize border border-zinc-200 dark:border-zinc-700 py-2 px-4">
                                    {{ $member->pivot->role }}</td>
                                <td class="border border-zinc-200 dark:border-zinc-700 py-2 px-4">
                                    <flux:button variant="danger" icon="trash"
                                        wire:click="removeMember({{ $member->id }})"></flux:button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <flux:text>{{ __('This shopping has no members') }}</flux:text>
            @endif
        </div>
        <div class="mt-4">
            <flux:heading size="lg" class="font-bold dark:font-bold">{{ __('Invite users') }}</flux:heading>
            <flux:subheading>{{ __('Invite other users to edit your shopping list') }}</flux:subheading>
            <form wire:submit="invite" class="flex flex-col gap-4 mt-2">
                <flux:input type="email" wire:model="userEmail" label="{{ __('User Email') }}" />
                <flux:error name="userEmail"></flux:error>
                <flux:select wire:model="role" label="{{ __('Role') }}" placeholder="{{ __('Role') }}">
                    <flux:select.option value="editor">{{ __('Editor') }}</flux:select.option>
                </flux:select>
                <flux:button variant="primary" type="submit">{{ __('Share') }}</flux:button>
            </form>
        </div>
    </div>
</div>
