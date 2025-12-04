<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_list_id',
        'name',
    ];

    protected $touches = ['shoppingList'];

    public function shoppingList(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
