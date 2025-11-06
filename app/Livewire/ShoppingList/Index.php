<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // public $shopping_lists;

    public function mount()
    {
        // $this->shopping_lists = ShoppingList::paginate(5);
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
        $query = ShoppingList::where(function ($q) {
            $q->where('owner_id', Auth::id());
        });

        $shopping_lists = $query->orderByDesc()->paginate(5);

        return view('livewire.shopping-list.index', compact('shopping_lists'));
    }
}
