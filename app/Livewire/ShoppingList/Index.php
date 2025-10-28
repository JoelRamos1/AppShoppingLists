<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
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
        $query = ShoppingList::where(function ($q) {
            $q->where('owner_id', Auth::id());
        });

        $shopping_lists = $query->get();

        return view('livewire.shopping-list.index', compact('shopping_lists'));
    }
}
