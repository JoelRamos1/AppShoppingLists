<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'is_shared',
    ];

    protected function casts(): array
    {
        return [
            'is_shared' => 'boolean',
        ];
    }

    // Returns the owner of the list
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Returns the members (owner, editors) of the shopping list
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shopping_list_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    // Returns the categories of the shopping list
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->owner_id === $user->id;
    }

    // Scopes
    public function scopeShared($query)
    {
        return $query->where('is_shared', true);
    }

    public function scopeOwnedBy($query, User $user)
    {
        return $query->where('owner_id', $user->id);
    }

    public function hasMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }

    public function canBeEditedBy(User $user)
    {
        return $this->isOwnedBy($user) ||
               $this->members()
                    ->where('user_id', $user->id)
                    ->wherePivot('role', 'editor')
                    ->exists();
    }
}
