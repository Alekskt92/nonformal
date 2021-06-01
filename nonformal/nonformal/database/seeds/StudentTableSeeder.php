<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ru_RU');

        DB::table('students')->insert(
            [
                [
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'patronymic' => $faker->middleName,
                    'student_uuid' => '4e79597c-1a71-3018-855c-c84843ae5973',
                    'group_uuid' => 'be98ffb7-4e99-3a81-8b40-d6d6b6dc0795',
                ],
                [
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'patronymic' => $faker->middleName,
                    'student_uuid' => 'c9851aaf-c33e-3e85-af6c-d15d588478fe',
                    'group_uuid' => 'd5d4a6c5-f78f-34b3-aefc-0b7e9bae6bfe',
                ]
            ]
        );
    }
}
