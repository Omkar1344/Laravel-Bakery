<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Chocolate Cake',
                'description' => 'Rich and moist chocolate cake with chocolate frosting',
                'price' => 599.99,
                'category' => 'Cakes',
                'stock' => 10,
            ],
            [
                'name' => 'Vanilla Cupcake',
                'description' => 'Soft vanilla cupcake with buttercream frosting',
                'price' => 89.99,
                'category' => 'Cupcakes',
                'stock' => 20,
            ],
            [
                'name' => 'Croissant',
                'description' => 'Buttery and flaky French croissant',
                'price' => 79.99,
                'category' => 'Pastries',
                'stock' => 15,
            ],
            [
                'name' => 'Red Velvet Cake',
                'description' => 'Classic red velvet cake with cream cheese frosting',
                'price' => 699.99,
                'category' => 'Cakes',
                'stock' => 8,
            ],
            [
                'name' => 'Chocolate Chip Cookie',
                'description' => 'Freshly baked chocolate chip cookies',
                'price' => 49.99,
                'category' => 'Cookies',
                'stock' => 30,
            ],
            [
                'name' => 'Blueberry Muffin',
                'description' => 'Moist muffin with fresh blueberries',
                'price' => 69.99,
                'category' => 'Muffins',
                'stock' => 12,
            ],
            [
                'name' => 'Cheesecake',
                'description' => 'Creamy New York style cheesecake',
                'price' => 499.99,
                'category' => 'Cakes',
                'stock' => 6,
            ],
            [
                'name' => 'Almond Croissant',
                'description' => 'Croissant filled with almond cream',
                'price' => 99.99,
                'category' => 'Pastries',
                'stock' => 10,
            ],
            // New products
            [
                'name' => 'Tiramisu',
                'description' => 'Classic Italian dessert with coffee and mascarpone',
                'price' => 299.99,
                'category' => 'Desserts',
                'stock' => 8,
            ],
            [
                'name' => 'Macaron',
                'description' => 'French macarons in various flavors',
                'price' => 79.99,
                'category' => 'Pastries',
                'stock' => 25,
            ],
            [
                'name' => 'Eclair',
                'description' => 'Cream-filled pastry with chocolate glaze',
                'price' => 89.99,
                'category' => 'Pastries',
                'stock' => 15,
            ],
            [
                'name' => 'Fruit Tart',
                'description' => 'Buttery tart shell with custard and fresh fruits',
                'price' => 199.99,
                'category' => 'Tarts',
                'stock' => 6,
            ],
            [
                'name' => 'Cinnamon Roll',
                'description' => 'Sweet roll with cinnamon and cream cheese frosting',
                'price' => 99.99,
                'category' => 'Pastries',
                'stock' => 12,
            ],
            [
                'name' => 'Pumpkin Pie',
                'description' => 'Classic pumpkin pie with whipped cream',
                'price' => 399.99,
                'category' => 'Pies',
                'stock' => 5,
            ],
        ];

        // Create products directory if it doesn't exist
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }

        foreach ($products as $product) {
            // Use the correct image filename based on the product name
            $filename = Str::slug($product['name']) . '.jpg';
            
            // Check if the image exists in storage
            if (Storage::disk('public')->exists('products/' . $filename)) {
                $product['image'] = $filename;
            } else {
                // If image doesn't exist, use a default image
                $product['image'] = 'default-product.jpg';
            }
            
            Product::create($product);
        }
    }
} 