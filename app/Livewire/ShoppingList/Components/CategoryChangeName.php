<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\Category;
use Livewire\Component;

class CategoryChangeName extends Component
{
    public Category $category;

    public $newCategoryName = '';

    public function changeCategoryName()
    {
        $this->category->update([
            'name' => $this->newCategoryName,
        ]);

        $this->reset('newCategoryName');
        $this->category->refresh();

        $this->dispatch('category-updated', id: $this->category->id);
    }

    public function render()
    {
        return view('livewire.shopping-list.components.category-change-name');
    }
}
