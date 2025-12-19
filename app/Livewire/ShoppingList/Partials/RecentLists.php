<?php

namespace App\Livewire\ShoppingList\Partials;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RecentLists extends Component
{
    public $shoppingLists;

    public function mount(ShoppingList $shoppingLists)
    {
        $this->shoppingLists = ShoppingList::query()->where('owner_id', Auth::id())->latest()->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.shopping-list.partials.recent-lists');
    }
}
