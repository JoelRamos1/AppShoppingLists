<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShareMenu extends Component
{
    public ShoppingList $shoppingList;

    public $userEmail = '';

    public $role = 'editor';

    public function mount(ShoppingList $shoppingList) {
        $this->shoppingList = $shoppingList;
    }

    public function invite()
    {
        $this->validate([
            'userEmail' => 'required',
            'role' => 'required',
        ]);

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
    }

    public function render()
    {
        return view('livewire.shopping-list.components.share-menu');
    }
}
