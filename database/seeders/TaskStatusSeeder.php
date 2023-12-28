<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_statuses')->insert([
            [
                'name' => 'новая',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'завершена',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'выполняется',
                'created_at' => Carbon::now(),
            ],
            [
                'name' => '	в архиве',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
