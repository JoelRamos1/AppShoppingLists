<?php

namespace App\Livewire\ShoppingList\Components;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryChangeName extends Component
{
    public Category $category;

    #[Validate('required|string|max:255')]
    public string $newCategoryName = '';

    public function changeCategoryName()
    {
        $this->authorize('update', $this->category->shoppingList);

        $this->validate();

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
