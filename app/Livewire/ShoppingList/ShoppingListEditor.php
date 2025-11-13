<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShoppingListEditor extends Component
{
    public ShoppingList $shoppingList;

    public $newTitle = '';

    public function mount(int $id) {
        $this->shoppingList = ShoppingList::findOrFail($id);
    }

    public function updateTitle() {
        $this->authorize('update', $this->shoppingList);

        $this->shoppingList->update([
            'title' => $this->newTitle,
        ]);

        return $this->redirectRoute('shopping-lists.show', $this->shoppingList->id);
    }

    public function invite()
    {
        $this->validate();

        return $this->redirectRoute('shopping-lists.index');
    }

    public function render()
    {
        return view('livewire.shopping-list.shopping-list-editor');
    }
}
