<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	 
	     public function run()
    {
       // DB::table('categories')->truncate();
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Novel'],
            ['id' => 2, 'name' => 'Education'],

        ]);

    }

}
