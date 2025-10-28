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

        ShoppingList::create([
            'owner_id' => Auth::id(),
            'title' => $this->title,
        ]);

        session()->flash('success', 'Shopping list created successfully');

        return $this->redirectRoute('shopping-lists.index');
    }

    public function render()
    {
        return view('livewire.shopping-list.create');
    }
}
