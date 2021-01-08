<?php

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
      DB::table('categories')->insert([
        'name'=> 'Fatura',
      ]);

      DB::table('categories')->insert([
        'name'=> 'Borç',
      ]);

      DB::table('categories')->insert([
        'name'=> 'Vergi',
      ]);
    }
}
