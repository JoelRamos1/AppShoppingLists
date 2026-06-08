<?php

namespace App\Livewire\ShoppingList\Partials;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SharedLists extends Component
{
    public $shoppingLists;

    public int $totalProducts;

    public int $completedProducts;

    public function mount()
    {
        $this->shoppingLists = ShoppingList::query()->where('is_shared', true)->whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })->where('owner_id', '!=', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.shopping-list.partials.shared-lists');
    }
}
