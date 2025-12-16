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

    public string $sortBy = 'updated_at';

    public string $sortDirection = 'desc';

    public function reloadSearch()
    {
        $this->resetPage();
    }

    public function delete(string $id)
    {
        $shopping_list = ShoppingList::find($id);

        $this->authorize('delete', $shopping_list);

        if($shopping_list) {
            $shopping_list->delete();
        }

        $shopping_list->refresh();
    }

    public function render()
    {
        return view('livewire.shopping-list.index', ['shoppingLists' => ShoppingList::query()
                                                                                     ->when($this->sortBy === 'title', function ($query) {
                                                                                        $query->orderByRaw('LOWER(title)' . $this->sortDirection);
                                                                                     }, function ($query) {
                                                                                        $query->orderBy($this->sortBy, $this->sortDirection);
                                                                                     })
                                                                                     ->where('owner_id', Auth::id())
                                                                                     ->where('title', 'like', '%' . $this->search . '%')
                                                                                     ->paginate(10)]);
    }
}
