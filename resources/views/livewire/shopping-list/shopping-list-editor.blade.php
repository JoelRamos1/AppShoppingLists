<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div>
        <flux:heading size="xl">{{ __('Editing Shopping List ') . $shoppingList->title }}</flux:heading>
    </div>

    <div>
        <div>
            <flux:heading size="lg">{{ __('Basic Information') }}</flux:heading>
            <form wire:submit="updateTitle" class="mt-2 flex flex-col gap-4">
                <flux:input type="text" label="{{ __('Update Title') }}" placeholder="{{ $shoppingList->title }}"
                    wire:model="newTitle" clearable>
                    <x-slot>{{ $shoppingList->title }}</x-slot>
                </flux:input>
                <flux:button variant="primary" icon="arrow-path" type="submit">{{ __('Update Title') }}</flux:button>
            </form>
        </div>
        <flux:separator class="my-4"></flux:separator>
        <div>
            <flux:heading size="lg">{{ __('Share this Shopping List') }}</flux:heading>
            <flux:subheading>{{ __('Share this shopping list with another user') }}</flux:subheading>
            @if ($shoppingList->is_shared)
                <table class="border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 py-2 px-4">{{ __('Name') }}</th>
                            <th class="border border-gray-300 py-2 px-4">{{ __('Email') }}</th>
                            <th class="border border-gray-300 py-2 px-4">{{ __('Role') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shoppingList->members as $member)
                            <tr wire:key="{{$member->id}}">
                                <td class="border border-gray-300 py-2 px-4">{{ $member->name }}</td>
                                <td class="border border-gray-300 py-2 px-4">{{ $member->email }}</td>
                                <td class="capitalize border border-gray-300 py-2 px-4">{{ $member->pivot->role }}</td>
                                <td class="border border-gray-300 py-2 px-4"><flux:button variant="danger" icon="trash" wire:click="removeMember({{$member->id}})"></flux:button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>This list is not shared</p>
            @endif
            <form wire:submit="invite" class="mt-4 flex flex-col gap-4">
                <flux:input type="email" wire:model="userEmail" label="{{ __('User Email') }}" />
                <flux:error name="userEmail"></flux:error>
                {{-- <select wire:model="role" id="">
                <option value="Editor">Editor</option>
            </select> --}}
                <flux:select wire:model="role" label="{{ __('Role') }}" placeholder="{{ __('Role') }}">
                    <flux:select.option value="editor">{{ __('Editor') }}</flux:select.option>
                </flux:select>
                <flux:button variant="primary" type="submit">{{ __('Share') }}</flux:button>
            </form>
        </div>
    </div>
</div>
