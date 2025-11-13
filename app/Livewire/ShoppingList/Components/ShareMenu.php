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

    #[Validate('required|email|exists:users,email')]
    public string $inviteEmail;
    #[Validate('required|in:editor')]
    public $inviteRole;

    public function invite()
    {
        $this->validate();

        $user = User::where('email', $this->inviteEmail)->firstOrFail();

        // if ($this->shoppingList->members->contains($user)) {
        //     // $this->error = __('User already has access');
        //     return;
        // };

        $this->shoppingList->members()->attach($user->id, ['role' => $this->inviteRole]);

        $this->reset(['inviteEmail']);
    }

    public function render()
    {
        return view('livewire.shopping-list.components.share-menu');
    }
}
