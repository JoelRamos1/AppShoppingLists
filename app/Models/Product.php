<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'is_completed',
    ];

    protected $touches = ['category'];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tag(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    protected static function booted()
    {
        static::deleted(function ($product) {
            $product->tag()->each(function ($tag) {
                $tag->delete();
            });
        });
    }
}
