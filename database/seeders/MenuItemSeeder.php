<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = [
            // Drinks
            [
                'title' => 'Kopi Susu Calthea',
                'slug' => 'kopi-susu-calthea',
                'price' => 18000,
                'description' => 'Signature drink dengan susu segar dan gula aren pilihan.',
                'icon' => 'fa-glass-whiskey',
                'gradient' => 'from-coffee-200 to-coffee-400',
                'icon_color' => 'text-white',
                'category' => 'drink',
                'badge' => 'best-seller',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Hot Caffe Latte',
                'slug' => 'hot-caffe-latte',
                'price' => 20000,
                'description' => 'Kopi latte hangat dengan foam lembut sempurna.',
                'icon' => 'fa-mug-hot',
                'gradient' => 'from-amber-100 to-amber-200',
                'icon_color' => 'text-amber-700',
                'category' => 'drink',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Matcha Latte',
                'slug' => 'matcha-latte',
                'price' => 22000,
                'description' => 'Teh hijau premium dengan susu creamy.',
                'icon' => 'fa-blender',
                'gradient' => 'from-green-100 to-green-200',
                'icon_color' => 'text-green-600',
                'category' => 'drink',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Es Coklat',
                'slug' => 'es-coklat',
                'price' => 18000,
                'description' => 'Coklat dingin yang menyegarkan untuk cuaca panas.',
                'icon' => 'fa-cookie-bite',
                'gradient' => 'from-amber-200 to-amber-400',
                'icon_color' => 'text-amber-800',
                'category' => 'drink',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            
            // Foods
            [
                'title' => 'Nasgor Calthea',
                'slug' => 'nasgor-calthea',
                'price' => 20000,
                'description' => 'Nasi goreng spesial dengan bumbu rahasia Calthea.',
                'icon' => 'fa-bowl-rice',
                'gradient' => 'from-orange-100 to-orange-200',
                'icon_color' => 'text-orange-600',
                'category' => 'food',
                'badge' => 'favorit',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Roti Maryam',
                'slug' => 'roti-maryam',
                'price' => 12000,
                'description' => 'Roti maryam lembut dengan topping coklat/keju.',
                'icon' => 'fa-cookie',
                'gradient' => 'from-yellow-100 to-yellow-200',
                'icon_color' => 'text-yellow-700',
                'category' => 'food',
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Chicken Wings',
                'slug' => 'chicken-wings',
                'price' => 18000,
                'description' => 'Sayap ayam crispy dengan saus pilihan.',
                'icon' => 'fa-drumstick-bite',
                'gradient' => 'from-red-100 to-red-200',
                'icon_color' => 'text-red-600',
                'category' => 'food',
                'is_featured' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Kebab',
                'slug' => 'kebab',
                'price' => 15000,
                'description' => 'Kebab dengan daging dan sayuran segar.',
                'icon' => 'fa-hotdog',
                'gradient' => 'from-amber-100 to-amber-300',
                'icon_color' => 'text-amber-700',
                'category' => 'food',
                'is_featured' => true,
                'sort_order' => 8,
            ],
            
            // Snacks
            [
                'title' => 'French Fries',
                'slug' => 'french-fries',
                'price' => 12000,
                'description' => 'Kentang goreng crispy dengan bumbu pilihan.',
                'icon' => 'fa-french-fries',
                'gradient' => 'from-yellow-100 to-yellow-200',
                'icon_color' => 'text-yellow-600',
                'category' => 'snack',
                'sort_order' => 9,
            ],
            [
                'title' => 'Pisang Goreng',
                'slug' => 'pisang-goreng',
                'price' => 10000,
                'description' => 'Pisang goreng crispy dengan topping.',
                'icon' => 'fa-seedling',
                'gradient' => 'from-yellow-200 to-amber-200',
                'icon_color' => 'text-amber-600',
                'category' => 'snack',
                'sort_order' => 10,
            ],
            [
                'title' => 'Banana Nugget',
                'slug' => 'banana-nugget',
                'price' => 12000,
                'description' => 'Nugget pisang dengan topping coklat.',
                'icon' => 'fa-apple-whole',
                'gradient' => 'from-amber-100 to-amber-200',
                'icon_color' => 'text-amber-700',
                'category' => 'snack',
                'sort_order' => 11,
            ],
            [
                'title' => 'Cireng',
                'slug' => 'cireng',
                'price' => 8000,
                'description' => 'Cireng isi dengan bumbu kacang.',
                'icon' => 'fa-circle',
                'gradient' => 'from-orange-100 to-orange-200',
                'icon_color' => 'text-orange-500',
                'category' => 'snack',
                'sort_order' => 12,
            ],
            [
                'title' => 'Tahu Cabe Garam',
                'slug' => 'tahu-cabe-garam',
                'price' => 10000,
                'description' => 'Tahu goreng dengan bumbu cabe garam.',
                'icon' => 'fa-pepper-hot',
                'gradient' => 'from-red-100 to-red-200',
                'icon_color' => 'text-red-500',
                'category' => 'snack',
                'sort_order' => 13,
            ],
            [
                'title' => 'Lumpia Sayur',
                'slug' => 'lumpia-sayur',
                'price' => 10000,
                'description' => 'Lumpia isi sayuran segar.',
                'icon' => 'fa-leaf',
                'gradient' => 'from-green-100 to-green-200',
                'icon_color' => 'text-green-600',
                'category' => 'snack',
                'sort_order' => 14,
            ],
        ];

        foreach ($menuItems as $item) {
            \App\Models\MenuItem::create($item);
        }
    }
}
