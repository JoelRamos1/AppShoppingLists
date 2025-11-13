<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|string|max:255')]
    public $title = '';

    public function save()
    {
        $this->validate();

        $shoppingList = ShoppingList::create([
            'owner_id' => Auth::id(),
            'title' => $this->title,
        ]);

        $shoppingList->members()->attach(Auth::id(), ['role' =>'owner']);

        // $list = ShoppingList::latest()->first();

        session()->flash('success', 'Shopping list created successfully');

        return $this->redirectRoute('shopping-lists.show', $shoppingList->id);
    }

    public function render()
    {
        return view('livewire.shopping-list.create');
    }
}
