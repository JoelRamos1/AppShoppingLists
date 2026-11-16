<?php

namespace App\Livewire\ShoppingList;

use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Create extends Component
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    public function save()
    {
        $this->validate();

        $shoppingList = ShoppingList::create([
            'owner_id' => Auth::id(),
            'title' => $this->title,
        ]);

        $shoppingList->members()->attach(Auth::id(), ['role' => 'owner']);

        // $list = ShoppingList::latest()->first();

        session()->flash('success', 'Shopping list created successfully');

        return $this->redirectRoute('shopping-lists.show', $shoppingList->id);
    }

    #[Title('Create Shopping List')]
    public function render()
    {
        return view('livewire.shopping-list.create');
    }
}
