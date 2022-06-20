<?php

use Illuminate\Database\Seeder;
use App\Project;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	 
	     public function run()
    {
       // DB::table('categories')->truncate();
        DB::table('Projects')->insert([
            ['id' => 1, 'name' => 'Project 1'],
            ['id' => 2, 'name' => 'Project 2'],
            ['id' => 3, 'name' => 'Project 3'],
            ['id' => 4, 'name' => 'Project 4'],

        ]);

    }

}
