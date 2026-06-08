<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\ShoppingList;
use App\Models\User;
use Livewire\Component;

class ShoppingListItem extends Component
{
    public ShoppingList $shoppingList;

    public int $totalProducts;

    public int $completedProducts;

    public string $newTitle = '';

    public string $userEmail = '';

    public string $role = 'editor';

    public function mount(ShoppingList $shoppingList)
    {
        $this->shoppingList = $shoppingList;
        $this->totalProducts = $shoppingList->products()->count();
        $this->completedProducts = $shoppingList->products()->where('is_completed', true)->count();
    }

    public function delete()
    {
        $this->authorize('delete', $this->shoppingList);

        $this->shoppingList->delete();

        $this->dispatch('list-deleted', id: $this->shoppingList->id);
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

    public function render()
    {
        return view('livewire.shopping-list.components.shopping-list-item');
    }
}
