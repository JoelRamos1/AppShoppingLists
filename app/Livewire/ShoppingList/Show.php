<?php

namespace App\Livewire\ShoppingList;

use App\Models\Category;
use App\Models\ShoppingList;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    public $id;

    public ShoppingList $shopping_list;

    #[Validate('required|string|max:255')]
    public $name = '';

    public $newTitle = '';

    public function mount()
    {
        $this->shopping_list = ShoppingList::find($this->id);
    }

    #[On('category-delete')]
    public function refreshShoppingList(int $id)
    {
        $this->shopping_list->refresh();
    }

    public function deleteShoppingList()
    {
        $this->authorize('delete', $this->shopping_list);

        $this->shopping_list->delete();

        $this->redirectRoute('shopping-lists.index');
    }

    public function save()
    {
        $this->validate();

        $this->authorize('create', $this->shopping_list);

        Category::create([
            'shopping_list_id' => $this->id,
            'name' => $this->name,
        ]);

        session()->flash('success', 'Category created successfully');

        $this->shopping_list->refresh();
        // $this->redirectRoute('shopping-lists.show', $this->id);
    }

    public function render()
    {
        $this->authorize('view', $this->shopping_list);

         return view('livewire.shopping-list.show');
    }
}
