<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'stock'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $url = Storage::disk('public')->url('products/' . $this->image);
            // Replace the domain with the current server address
            $currentUrl = request()->getSchemeAndHttpHost();
            return str_replace(config('app.url'), $currentUrl, $url);
        }
        return asset('images/default-product.jpg');
    }
} 