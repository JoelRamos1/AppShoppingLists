<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Shared extends Component
{
    use WithPagination;

    public function render()
    {
        $shoppingLists = Auth::user()->sharedLists->where('owner_id', '<>', Auth::id());
        return view('livewire.shopping-list.shared', compact('shoppingLists'));
    }
}
