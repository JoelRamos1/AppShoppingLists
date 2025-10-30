<?php

namespace App\Livewire\ShoppingList;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryEditor extends Component
{
    public Category $category;

    #[Validate('required|string|max:255')]
    public $name = '';

    public array $newProductNames = [];

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function newProduct()
    {
        $this->validate();

        $this->category->products()->create([
            'name' => $this->name,
        ]);

        $this->category->load('products');

        $this->reset('name');
    }

    public function checkProduct(int $id)
    {
        $product = Product::find($id);

        $product->update([
            'is_completed' => ! $product->is_completed,
        ]);

        $this->category->load('products');
    }

    public function updateProduct(int $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $this->newProductNames[$id],
        ]);

        $this->category->load('products');

        $this->reset('newProductNames');
    }

    public function deleteProduct(int $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        $this->category->load('products');
    }

    public function render()
    {
        return view('livewire.shopping-list.category-editor');
    }
}
