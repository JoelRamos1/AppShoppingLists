<?php

namespace Database\Factories;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingList>
 */
class ShoppingListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::all()->random()->id,
            'title' => fake()->word(),
        ];
    }

    public function withOwner(?User $user = null)
    {
        return $this->afterCreating(function (ShoppingList $shoppingList) use ($user) {
            $user = $user ?? User::factory()->create();

            $shoppingList->members()->attach($user->id, [
                'role' => 'owner',
            ]);
        });
    }
}
