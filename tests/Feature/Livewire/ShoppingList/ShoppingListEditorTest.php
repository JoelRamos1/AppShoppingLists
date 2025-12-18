<?php

namespace Tests\Feature\Livewire\ShoppingList;

use App\Livewire\ShoppingList\ShoppingListEditor;
use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShoppingListEditorTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $user->id,
            'title' => 'My List',
        ]);

        $this->actingAs($user);

        Livewire::test(ShoppingListEditor::class, ['id' => $list->id])
            ->assertStatus(200);
    }

    public function test_it_renders_the_editor()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $user->id,
            'title' => 'My List',
        ]);

        $this->actingAs($user);

        Livewire::test(ShoppingListEditor::class, ['id' => $list->id])
            ->assertSee('Edit Shopping List "My List"')
            ->assertSee(__('Information'))
            ->assertSee(__('Share'));
    }

    public function test_it_updates_the_title()
    {
        $user = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $user->id,
            'title' => 'Old Title',
        ]);

        $this->actingAs($user);

        Livewire::test(ShoppingListEditor::class, ['id' => $list->id])
            ->set('newTitle', 'New Title')
            ->call('updateTitle');

        $this->assertDatabaseHas('shopping_lists', [
            'id' => $list->id,
            'title' => 'New Title',
        ]);
    }

    public function test_it_invites_a_user_and_marks_list_as_shared()
    {
        $owner = User::factory()->create();
        $invitee = User::factory()->create(['email' => 'invitee@example.com']);
        $list = ShoppingList::factory()->create([
            'owner_id' => $owner->id,
            'title' => 'Shared List',
        ]);

        $this->actingAs($owner);

        Livewire::test(ShoppingListEditor::class, ['id' => $list->id])
            ->set('userEmail', $invitee->email)
            ->set('role', 'editor')
            ->call('invite');

        $this->assertTrue(
            $list->fresh()->members->contains($invitee)
        );

        $this->assertTrue($list->fresh()->is_shared);
    }

    public function test_it_removes_a_member()
    {
        $owner = User::factory()->create();
        $member = User::factory()->create();
        $list = ShoppingList::factory()->create([
            'owner_id' => $owner->id,
            'title' => 'Team List',
            'is_shared' => true,
        ]);

        $list->members()->attach($member->id, ['role' => 'editor']);

        $this->actingAs($owner);

        Livewire::test(ShoppingListEditor::class, ['id' => $list->id])
            ->call('removeMember', $member->id);

        $this->assertFalse(
            $list->fresh()->members->contains($member)
        );
    }
}
