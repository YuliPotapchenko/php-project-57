<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabelTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('label_task')->insert([
            [
                'task_id' => 1,
                'label_id' => 2,
            ],
            [
                'task_id' => 1,
                'label_id' => 4,
            ],
            [
                'task_id' => 2,
                'label_id' => 1,
            ],
            [
                'task_id' => 2,
                'label_id' => 3,
            ],
            [
                'task_id' => 2,
                'label_id' => 4,
            ],
            [
                'task_id' => 3,
                'label_id' => 1,
            ],
            [
                'task_id' => 3,
                'label_id' => 2,
            ],
            [
                'task_id' => 3,
                'label_id' => 3,
            ],
            [
                'task_id' => 4,
                'label_id' => 2,
            ],
            [
                'task_id' => 4,
                'label_id' => 4,
            ],
            [
                'task_id' => 5,
                'label_id' => 3,
            ],
            [
                'task_id' => 6,
                'label_id' => 1,
            ],
            [
                'task_id' => 6,
                'label_id' => 4,
            ],
            [
                'task_id' => 7,
                'label_id' => 1,
            ],
            [
                'task_id' => 8,
                'label_id' => 1,
            ],
            [
                'task_id' => 8,
                'label_id' => 2,
            ],
            [
                'task_id' => 8,
                'label_id' => 3,
            ],
            [
                'task_id' => 8,
                'label_id' => 4,
            ],
            [
                'task_id' => 9,
                'label_id' => 1,
            ],
            [
                'task_id' => 9,
                'label_id' => 2,
            ],
            [
                'task_id' => 9,
                'label_id' => 4,
            ],
            [
                'task_id' => 10,
                'label_id' => 2,
            ],
            [
                'task_id' => 10,
                'label_id' => 3,
            ],
            [
                'task_id' => 10,
                'label_id' => 4,
            ],
            [
                'task_id' => 11,
                'label_id' => 2,
            ],
            [
                'task_id' => 11,
                'label_id' => 4,
            ],
            [
                'task_id' => 12,
                'label_id' => 1,
            ],
            [
                'task_id' => 13,
                'label_id' => 4,
            ],
            [
                'task_id' => 14,
                'label_id' => 2,
            ],
            [
                'task_id' => 15,
                'label_id' => 1,
            ],
            [
                'task_id' => 15,
                'label_id' => 2,
            ],
            [
                'task_id' => 15,
                'label_id' => 3,
            ],
            [
                'task_id' => 16,
                'label_id' => 1,
            ],
            [
                'task_id' => 16,
                'label_id' => 2,
            ],
            [
                'task_id' => 16,
                'label_id' => 3,
            ],
        ]);
    }
}
