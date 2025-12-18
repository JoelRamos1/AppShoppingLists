<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\Category;
use App\Models\ShoppingList;
use Livewire\Component;

class ShoppingListItem extends Component
{
    public ShoppingList $shoppingList;

    public int $totalProducts;

    public int $completedProducts;

    public function mount(ShoppingList $shoppingList)
    {
        $this->shoppingList = $shoppingList;
        $this->totalProducts = $shoppingList->products()->count();
        $this->completedProducts = $shoppingList->products()->where('is_completed', true)->count();
    }

    public function delete()
    {
        $this->authorize('delete', $this->shoppingList);

        $this->shoppingList->delete();

        $this->dispatch('list-deleted', id: $this->shoppingList->id);
    }


    public function render()
    {
        return view('livewire.shopping-list.components.shopping-list-item');
    }
}
