<?php

use Illuminate\Database\Seeder;
//use \Illuminate\Support\Facades\DB;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $cName = 'Без категории';

        $categories[] = [
            'title'     => $cName,
            'slug'      => str_slug($cName),
            'parent_id' => 0,
        ];

        for ($i=1; $i<=10; $i++){
            $cName = 'Категория #' . $i;
            $parent_id = $i > 4 ? rand(1,4) : 1;
            
            $categories[] = [
                'title'     => $cName,
                'slug'      => str_slug($cName),
                'parent_id' => $parent_id,
            ];

        }
        
        DB::table('blog_categories')->insert($categories);
    }
}
