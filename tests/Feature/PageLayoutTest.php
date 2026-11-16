<?php

use App\Models\ShoppingList;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->actingAs($this->user);
});

test('authenticated pages render inside the application layout', function (string $routeName) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSee('<!DOCTYPE html>', false)
        ->assertSee(__('My Shopping Lists'));
})->with([
    'shopping lists index' => 'shopping-lists.index',
    'shared shopping lists' => 'shopping-lists.shared',
    'create shopping list' => 'shopping-lists.create',
    'test page' => 'test',
    'profile settings' => 'profile.edit',
    'password settings' => 'user-password.edit',
    'appearance settings' => 'appearance.edit',
]);

test('shopping list detail pages render inside the application layout', function (string $routeName) {
    $shoppingList = ShoppingList::factory()->create(['owner_id' => $this->user->id]);

    $this->get(route($routeName, $shoppingList->id))
        ->assertOk()
        ->assertSee('<!DOCTYPE html>', false)
        ->assertSee(__('My Shopping Lists'));
})->with([
    'show shopping list' => 'shopping-lists.show',
    'edit shopping list' => 'shopping-list.edit',
]);
