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
        User::create([
        	'name'=> 'José Gerardo Artavia Zuñiga',
            'email'=> 'jgaz52@gmail.com',
            'password'=> bcrypt('Condor52'),
            'admin' => true
        ]);
    }
}
