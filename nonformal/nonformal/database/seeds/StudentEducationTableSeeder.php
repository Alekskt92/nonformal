<?php

use Illuminate\Database\Seeder;

class StudentEducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ru_RU');

        DB::table('student_education')->insert(
            [
                [
                    'type_education' => 'Тип образования №1',
                    'sphere_education' => 'Сфера №1',
                    'duration' => 12,
                    'diploma' => 1,
                    'student_UUID' => '4e79597c-1a71-3018-855c-c84843ae5973',
                    'student_education_uuid' => $faker->uuid,
                ],
                [
                    'type_education' => 'Тип образования №2',
                    'sphere_education' => 'Сфера №2',
                    'duration' => 6,
                    'diploma' => 0,
                    'student_UUID' => 'c9851aaf-c33e-3e85-af6c-d15d588478fe',
                    'student_education_uuid' => $faker->uuid,
                ]
            ]
        );
    }
}
