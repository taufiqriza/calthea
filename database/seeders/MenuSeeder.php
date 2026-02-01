<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Seed menu items for Calthea.
     */
    public function run(): void
    {
        $items = [
            // Drinks
            [
                'name' => 'Kopi Susu Calthea',
                'category' => 'drink',
                'price' => 18000,
                'description' => 'Signature drink dengan susu segar dan gula aren pilihan.',
                'is_featured' => true,
            ],
            [
                'name' => 'Hot Caffe Latte',
                'category' => 'drink',
                'price' => 20000,
                'description' => 'Kopi latte hangat dengan foam lembut sempurna.',
                'is_featured' => true,
            ],
            [
                'name' => 'Matcha Latte',
                'category' => 'drink',
                'price' => 22000,
                'description' => 'Teh hijau premium dengan susu creamy.',
                'is_featured' => true,
            ],
            [
                'name' => 'Es Coklat',
                'category' => 'drink',
                'price' => 18000,
                'description' => 'Coklat dingin yang menyegarkan untuk cuaca panas.',
                'is_featured' => false,
            ],

            // Foods
            [
                'name' => 'Nasgor Calthea',
                'category' => 'food',
                'price' => 20000,
                'description' => 'Nasi goreng spesial dengan bumbu rahasia Calthea.',
                'is_featured' => true,
            ],
            [
                'name' => 'Roti Maryam',
                'category' => 'food',
                'price' => 12000,
                'description' => 'Roti maryam lembut dengan topping coklat/keju.',
                'is_featured' => true,
            ],
            [
                'name' => 'Chicken Wings',
                'category' => 'food',
                'price' => 18000,
                'description' => 'Sayap ayam crispy dengan saus pilihan.',
                'is_featured' => false,
            ],
            [
                'name' => 'Kebab',
                'category' => 'food',
                'price' => 15000,
                'description' => 'Kebab dengan daging dan sayuran segar.',
                'is_featured' => false,
            ],

            // Bundling (from poster)
            [
                'name' => 'Bundling Weekend 25K',
                'category' => 'food',
                'price' => 25000,
                'description' => 'Paket Nasgor Calthea + Kopi Susu Calthea.',
                'is_featured' => true,
            ],
            [
                'name' => 'Bundling Weekend 15K',
                'category' => 'food',
                'price' => 15000,
                'description' => 'Paket Maryam + Hot Caffe Latte.',
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Rooftop Night 20K',
                'category' => 'food',
                'price' => 20000,
                'description' => 'Chicken wings, kebab, drink, fireworks (free).',
                'is_featured' => true,
            ],
            [
                'name' => 'Paket Rooftop Night 26K',
                'category' => 'food',
                'price' => 26000,
                'description' => 'Chicken drumstick, BBQ (grilled corn & sausage), drink, fireworks (free).',
                'is_featured' => true,
            ],

            // Snacks
            [
                'name' => 'French Fries',
                'category' => 'snack',
                'price' => 12000,
                'description' => 'Kentang goreng crispy dengan bumbu pilihan.',
                'is_featured' => false,
            ],
            [
                'name' => 'Pisang Goreng',
                'category' => 'snack',
                'price' => 10000,
                'description' => 'Pisang goreng crispy dengan topping.',
                'is_featured' => false,
            ],
            [
                'name' => 'Banana Nugget',
                'category' => 'snack',
                'price' => 12000,
                'description' => 'Nugget pisang dengan topping coklat.',
                'is_featured' => false,
            ],
            [
                'name' => 'Cireng',
                'category' => 'snack',
                'price' => 8000,
                'description' => 'Cireng isi dengan bumbu kacang.',
                'is_featured' => false,
            ],
            [
                'name' => 'Tahu Cabe Garam',
                'category' => 'snack',
                'price' => 10000,
                'description' => 'Tahu goreng dengan bumbu cabe garam.',
                'is_featured' => false,
            ],
            [
                'name' => 'Lumpia Sayur',
                'category' => 'snack',
                'price' => 10000,
                'description' => 'Lumpia isi sayuran segar.',
                'is_featured' => false,
            ],
        ];

        foreach ($items as $item) {
            $slug = Str::slug($item['name']);
            Menu::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $item['name'],
                    'category' => $item['category'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'is_available' => true,
                    'is_featured' => $item['is_featured'],
                ]
            );
        }
    }
}
