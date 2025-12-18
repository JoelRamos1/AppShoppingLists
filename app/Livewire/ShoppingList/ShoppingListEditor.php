<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShoppingListEditor extends Component
{
    public ShoppingList $shoppingList;

    public string $newTitle = '';

    public string $userEmail = '';

    public string $role = 'editor';

    public function mount(int $id) {
        $this->shoppingList = ShoppingList::findOrFail($id);
    }

    public function updateTitle() {
        $this->authorize('update', $this->shoppingList);

        $this->shoppingList->update([
            'title' => $this->newTitle,
        ]);


        $this->shoppingList->refresh();
        // return $this->redirectRoute('shopping-lists.show', $this->shoppingList->id);
    }

    public function shareList()
    {
        $this->authorize('update', $this->shoppingList);

        $this->shoppingList->update([
            'is_shared' => ! $this->shoppingList->is_shared,
        ]);

        $this->shoppingList->refresh();
    }

    public function invite()
    {
        $this->validate([
            'userEmail' => 'required|string|max:255',
            'role' => 'required',
        ]);

        $this->authorize('invite', $this->shoppingList);

        $user = User::where('email', $this->userEmail)->first();

        if ($this->shoppingList->members->contains($user)) {
            return;
        }

        $this->shoppingList->members()->attach($user->id, ['role' => $this->role]);

        $this->shoppingList->update([
            'is_shared' => true,
        ]);

        $this->shoppingList->load('members');

        $this->reset(['userEmail']);

        // return $this->redirectRoute('shopping-lists.index');
    }

    public function removeMember(int $userId)
    {
        $this->authorize('invite', $this->shoppingList);

        $user = User::findOrFail($userId);

        if ($this->shoppingList->isOwnedBy($user)) {
            return;
        }

        $this->shoppingList->members()->detach($user->id);

        $this->shoppingList->load('members');

        // return back();
    }

    public function render()
    {
        return view('livewire.shopping-list.shopping-list-editor');
    }
}
