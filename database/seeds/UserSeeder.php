<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	 
    public function run()
    {
        User::create([
            'name'          => 'Super User',
            'email'         => 'admin@admin.com',
            'password'      => Hash::make('123456'),
            'user_role_id'      =>'1',
            'hour_rate'      =>'0',

        ]);
        User::create([
            'name'          => 'Employe one',
            'email'         => 'employ1@gmaail.com',
            'password'      => Hash::make('123456'),
            'user_role_id'      =>'2',
            'hour_rate'      =>'1000',

        ]);
        User::create([
            'name'          => 'Employe two',
            'email'         => 'employ2@gmaail.com',
            'password'      => Hash::make('123456'),
            'user_role_id'      =>'2',
            'hour_rate'      =>'2000',

        ]);
       
    }
}
