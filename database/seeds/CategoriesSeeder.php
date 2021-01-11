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
        ['id'=>1, 'name'=>'Fatura'],
        ['id'=>2, 'name'=>'Borç'],
        ['id'=>3, 'name'=>'Vergi'],
      ];
      Category::insert($categorySeed);
    }
}
