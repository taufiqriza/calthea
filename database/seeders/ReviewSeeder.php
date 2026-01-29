<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'name' => 'Andi Pratama',
                'location' => 'Jakarta',
                'rating' => 5,
                'review' => 'Kopi terbaik yang pernah saya coba! Suasananya sangat nyaman untuk bekerja atau hangout bersama teman. Pasti akan kembali lagi!',
                'avatar_color' => 'bg-coffee-200',
                'is_featured' => true,
                'is_approved' => true,
            ],
            [
                'name' => 'Sarah Dewi',
                'location' => 'Bandung',
                'rating' => 5,
                'review' => 'Caramel Latte-nya juara banget! Staff-nya ramah dan pelayanannya cepat. Tempatnya juga cocok untuk foto-foto aesthetic.',
                'avatar_color' => 'bg-pink-200',
                'is_featured' => true,
                'is_approved' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'location' => 'Surabaya',
                'rating' => 5,
                'review' => 'Sebagai pecinta kopi, saya sangat terkesan dengan kualitas biji kopi yang digunakan. Aroma dan rasanya luar biasa. Worth it!',
                'avatar_color' => 'bg-blue-200',
                'is_featured' => true,
                'is_approved' => true,
            ],
            [
                'name' => 'Dina Lestari',
                'location' => 'Malang',
                'rating' => 5,
                'review' => 'Tempatnya asri banget dengan view alam yang indah. Menu makanannya juga enak-enak. Recommended!',
                'avatar_color' => 'bg-green-200',
                'is_featured' => false,
                'is_approved' => true,
            ],
            [
                'name' => 'Rizky Firmansyah',
                'location' => 'Batu',
                'rating' => 5,
                'review' => 'Cafe favorit di Batu! Harga terjangkau, porsi pas, dan suasana nyaman. Cocok untuk nongkrong bareng keluarga.',
                'avatar_color' => 'bg-amber-200',
                'is_featured' => false,
                'is_approved' => true,
            ],
        ];

        foreach ($reviews as $review) {
            \App\Models\Review::create($review);
        }
    }
}
