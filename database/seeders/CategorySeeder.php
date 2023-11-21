<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $categories = [

            [
                'name_en' => 'Single Drama',
                'name_bn' => 'নাটক',
            ],
            [
                'name_en' => 'Drama Series',
                'name_bn' => 'ধারাবাহিক নাটক',
            ],
            [
                'name_en' => 'Movie',
                'name_bn' => 'সিনেমা',
            ],
            [
                'name_en' => 'Music Video',
                'name_bn' => 'মিউজিক ভিডিও',
            ],
            [
                'name_en' => 'Tv Show',
                'name_bn' => 'টিভি শো',
            ],
            [
                'name_en' => 'Short Film',
                'name_bn' => 'শর্ট ফিল্ম',
            ],
            [
                'name_en' => 'Web Film',
                'name_bn' => 'ওয়েব ফিল্ম',
            ],

        ];

        foreach ($categories as $category) {
            Category::create([
                ...$category,
                'cat_code' => 'RT'.strtoupper(substr($category['name_en'], 0, 3)),
                'created_by' => $user->id,
            ]);
        }
    }
}
