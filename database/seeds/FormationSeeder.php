<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormationSeeder extends Seeder
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

        $data = array("Java", "JavaScript", "SQL Server", "Python", "Ruby", "PHP and Laravel",
            "Dijango", "ReactJS", "VueJS", "NodeJS and Express", "NextJS", "NuxtJS"
        );

        $limit = 12;

        DB::table('formations')->insert([
            'intitule' => 'Gao vien',
            'deleted_at' => 1
        ]);

        for ($i = 0; $i < $limit; $i++) {
            DB::table('formations')->insert([
                'intitule' => $data[$i],
                'deleted_at' => 0
            ]);
        }

    }
}
