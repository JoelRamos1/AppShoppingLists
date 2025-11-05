<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $shopping_lists;

    public function mount()
    {
        $query = ShoppingList::where(function ($q) {
            $q->where('owner_id', Auth::id());
        });

        $this->shopping_lists = $query->get();
    }

    public function delete(string $id)
    {
        $shopping_list = ShoppingList::find($id);

        if($shopping_list) {
            $shopping_list->delete();
        }

        return $this->redirect('/shopping-lists/index');
        // $this->shopping_lists->load();
    }

    public function render()
    {
        return view('livewire.shopping-list.index');
    }
}
