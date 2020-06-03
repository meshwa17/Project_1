<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
         User::create([
        	'name'=>'bhaumikteacher',
        	'username'=>'bhaumik',
        	'email'=>'bhaumik@gmail.com',
        	'password'=>bcrypt('bhaumik'),
            'role_id'=>2, 
            'active'=>1,
        	'remember_token'=>str_random(10),

        ]);
    }
}
