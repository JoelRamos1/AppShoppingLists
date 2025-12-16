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

    public string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.shopping-list.shared', ['shoppingLists' => ShoppingList::where('is_shared', true)
            ->whereHas('members', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('owner_id', '!=', Auth::id())
            ->where('title', 'like', '%' . $this->search . '%')
            ->paginate(10)]);
    }
}
