<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categorySeed=[
        ['name'=>'Fatura'],
        ['name'=>'Borç'],
        ['name'=>'Vergi'],
      ];
      Category::create($categorySeed);
    }
}
