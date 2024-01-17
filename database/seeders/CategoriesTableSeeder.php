<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 2) as $index) {
            $parentCategory = Categories::create([
                'name' => $faker->word,
                'parent_id' => null,
            ]);

            $this->createChildCategories($parentCategory, 2, $faker);
        }
    }

    public function createChildCategories($parentCategory, $depth, $faker)
    {
        if ($depth === 0) {
            return;
        }

        foreach (range(1,1) as $index) {
            $childCategory = Categories::create([
                'name' => $faker->word,
                'parent_id' => $parentCategory->id,
            ]);

            $this->createChildCategories($childCategory, $depth - 1, $faker);
        }
    }
    
}
