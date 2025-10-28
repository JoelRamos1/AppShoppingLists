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
        return $this->belongsToMany(User::class, 'list_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
