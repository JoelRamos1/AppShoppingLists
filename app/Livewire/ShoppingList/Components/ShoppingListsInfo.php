<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShoppingListsInfo extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.shopping-list.components.shopping-lists-info', ['shoppingLists' => ShoppingList::Where('owner_id', Auth::id())->latest()->paginate(5)]);
    }
}
