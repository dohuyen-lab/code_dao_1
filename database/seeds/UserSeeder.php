<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        DB::table('users')->insert([
            'nom' => $faker->firstName,
            'prenom' => $faker->lastName,
            'login' => 'admin',
            'mdp' => Hash::make('admin12345'),
            'formation_id' => 1,
            'type' => 'admin'
        ]);
    }
}
