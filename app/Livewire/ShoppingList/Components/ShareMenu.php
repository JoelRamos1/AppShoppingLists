<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\ShoppingList;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShareMenu extends Component
{
    #[Validate('required|email|exists:users,email')]
    public string $userEmail;
    #[Validate('required|in:editor')]
    public $role;

    public function invite(ShoppingList $shoppingList)
    {
        $this->validate();

        $invite = User::where('email', $this->userEmail)->firstOrFail();

        $already = $shoppingList->members()
                                ->where('user_id', $invite->id);

        if ($already) {
            return;
        }

        $shoppingList->members()->attach($invite->id, ['role' => $this->role]);


    }

    public function render()
    {
        return view('livewire.shopping-list.components.share-menu');
    }
}
