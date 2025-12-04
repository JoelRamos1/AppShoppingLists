<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $touches = ['product'];

    protected function casts(): array
    {
        return [
            'name' => 'string',
        ];
    }

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }
}
