<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'is_shared',
    ];

    public function owner()
    {
        return $this->belongTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'shopping_list_user', 'user_id', 'shopping_list_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // public function isOwnedBy(User $user): bool
    // {
    //     return $this->owner_id === $user->id;
    // }

    // public function canBeEditedBy(User $user)
    // {
    //     return $this->isOwnedBy($user) ||
    //            $this->members()
    //                 ->where('user_id', $user->id)
    //                 ->wherePivot('role', 'editor')
    //                 ->exists();
    // }
}
