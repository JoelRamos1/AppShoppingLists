<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Shared extends Component
{
    public $shoppingLists;

    public function mount()
    {
        $user = Auth::user();

        // $this->shoppingLists = ShoppingList::where('is_shared', true)->get();

        $this->shoppingLists = ShoppingList::where('is_shared', true)
            ->where('owner_id', '!=', $user->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.shopping-list.shared');
    }
}
