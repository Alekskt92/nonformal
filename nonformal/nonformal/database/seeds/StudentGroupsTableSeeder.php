<?php

use Illuminate\Database\Seeder;

class StudentGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('group_students')->insert(
            [
                [
                    'name_group' => 'Group #1',
                    'group_uuid' => 'd5d4a6c5-f78f-34b3-aefc-0b7e9bae6bfe',

                ],
                [
                    'name_group' => 'Group #2',
                    'group_uuid' => 'be98ffb7-4e99-3a81-8b40-d6d6b6dc0795',
                ]
            ]

        );
    }
}
