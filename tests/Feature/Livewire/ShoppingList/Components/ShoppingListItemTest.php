<?php

use App\Livewire\ShoppingList\Components\ShoppingListItem;
use App\Models\ShoppingList;
use App\Models\User;
use Livewire\Livewire;

test('long titles are truncated but remain available as a tooltip', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $shoppingList = ShoppingList::factory()->create([
        'owner_id' => $user->id,
        'title' => str_repeat('A very long shopping list title ', 5),
    ]);

    Livewire::test(ShoppingListItem::class, ['shoppingList' => $shoppingList])
        ->assertSeeHtml('class="block truncate font-semibold"')
        ->assertSeeHtml('title="'.$shoppingList->title.'"');
});
