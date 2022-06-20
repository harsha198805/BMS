<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

       	 
	     public function run()
    {
       // DB::table('tags')->truncate();
        DB::table('tags')->insert([
            ['id' => 1, 'name' => 'Local'],
            ['id' => 2, 'name' => 'Education'],

        ]);

    }

}
