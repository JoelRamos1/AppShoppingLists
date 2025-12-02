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

    public string $search = '';

    // protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

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
        return view('livewire.shopping-list.index', ['shoppingLists' => ShoppingList::where('owner_id', Auth::id())
                                                                                     ->where('title', 'like', '%' . $this->search . '%')
                                                                                     ->latest()
                                                                                     ->paginate(10)]);
    }
}
