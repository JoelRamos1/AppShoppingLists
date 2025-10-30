<?php

namespace App\Livewire\ShoppingList;

use App\Models\Category;
use App\Models\ShoppingList;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    public $id;

    public ShoppingList $shopping_list;

    #[Validate('required|string|max:255')]
    public $name = '';

    public $newTitle;

    public function mount()
    {
        $this->shopping_list = ShoppingList::find($this->id);
    }

    public function updateTitle() {
        // $this->validate([
        //     'newTitle' => 'required|string|max:255',
        // ]);

        $this->shopping_list->update([
            'title' => $this->newTitle,
        ]);

        $this->reset('newTitle');
    }

    public function deleteShoppingList()
    {
        $this->shopping_list->delete();

        $this->redirect('shopping-lists.index');
    }

    public function save()
    {
        $this->validate();

        Category::create([
            'shopping_list_id' => $this->id,
            'name' => $this->name,
        ]);

        session()->flash('success', 'Category created successfully');

        $this->redirectRoute('shopping-lists.show', $this->id);
    }

    public function delete(int $id) {
        $category = Category::findOrFail($id);

        $category->delete();

        $this->redirectRoute('shopping-lists.show', $this->id);
    }

    public function render()
    {
       return view('livewire.shopping-list.show');
    }
}
