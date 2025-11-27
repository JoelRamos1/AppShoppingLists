<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(string $id)
    {
        $shopping_list = ShoppingList::find($id);

        if($shopping_list) {
            $shopping_list->delete();
        }

        return $this->redirect('/shopping-lists/index');
    }

    public function render()
    {
        $user = User::find(Auth::id());

        return view('livewire.shopping-list.index', ['shoppingLists' => ShoppingList::ownedBy($user)
                                                                                     ->latest()
                                                                                     ->paginate(10)]);
    }
}
