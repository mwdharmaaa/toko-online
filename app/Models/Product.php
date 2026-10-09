<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'price',
        'stock',
        'summary',
        'description',
        'specifications',
        'image_path',
        'is_featured',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
            'stock' => 'integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'specifications' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->sku)) {
                $product->sku = 'MN-' . strtoupper(Str::random(6));
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function (Builder $subQuery) use ($term) {
            $subQuery->where('name', 'like', "%{$term}%")
                ->orWhere('sku', 'like', "%{$term}%")
                ->orWhere('summary', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->price, 0, ',', '.')
        );
    }

    protected function inStock(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->stock > 0
        );
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (empty($this->image_path)) {
                    return null;
                }
                if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
                    return $this->image_path;
                }
                return asset('storage/' . ltrim($this->image_path, '/'));
            }
        );
    }
}
