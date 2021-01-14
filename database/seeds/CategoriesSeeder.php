<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorySeed = [
        ['name' => 'Fatura'],
        ['name' => 'Borç'],
        ['name' => 'Vergi'],
      ];

        foreach ($categorySeed as $seed) {
            Category::create($seed);
        }
    }
}
