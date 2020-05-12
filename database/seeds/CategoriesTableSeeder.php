<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Chaises',
            'slug' => 'chaises'
        ]);

        Category::create([
            'name' => 'Canapés',
            'slug' => 'canapés'
        ]);

        Category::create([
            'name' => 'Meubles',
            'slug' => 'meubles'
        ]);

        Category::create([
            'name' => 'Tables',
            'slug' => 'tables'
        ]);
    }
}
