<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShoppingListEditor extends Component
{
    public ShoppingList $shopping_list;

    #[Validate('required|string|max:255')]
    public $newTitle;

    public function mount(ShoppingList $shopping_list)
    {
        $this->shopping_list = $shopping_list;
    }

    public function updateName(int $id) {
        $this->validate();

        $shopping_list = ShoppingList::findOrFail($id);

        $shopping_list->update([
            'title' => $this->newTitle,
        ]);

        $this->reset('newTitle');

        $this->shopping_list->load('categories');
    }

    public function render()
    {
        return view('livewire.shopping-list.shopping-list-editor');
    }
}
