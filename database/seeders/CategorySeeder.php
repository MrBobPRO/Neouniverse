<?php

namespace Database\Seeders;

use App\Models\ProductsCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodCat = ['Аллергология', 'Антимикробные препараты', 'Витамины и минералы', 'Гематология', 'Гинекология', 'Глюкокортикостероиды', 'Дерматология', 'Дыхательная система'];

        for($i = 0; $i < count($prodCat); $i++) {
            $category = new ProductsCategory();
            $category->ru_name = $prodCat[$i];
            $category->en_name = $prodCat[$i];
            $category->ka_name = $prodCat[$i];
            $category->save();
        }
    }
}
