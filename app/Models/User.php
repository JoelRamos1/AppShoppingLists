<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    // Returns owned shopping lists
    public function ownedLists(): HasMany
    {
        return $this->hasMany(ShoppingList::class, 'owner_id');
    }

    // returns shared shopping lists
    public function sharedLists(): BelongsToMany
    {
        return $this->belongsToMany(ShoppingList::class, 'shopping_list_user', 'user_id', 'shopping_list_id')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function owns(ShoppingList $shoppingList): bool
    {
        return $shoppingList->owner_id === $this->id;
    }

    public function canEdit(ShoppingList $shoppingList): bool
    {
        return $this->owns($shoppingList) ||
               $shoppingList->members()
                   ->where('user_id')
                   ->wherePivot('role', 'editor')
                   ->exists();
    }
}
