<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskStatus;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['новый', 'в работе', 'на тестировании', 'завершен'];
        foreach ($data as $value) {
            $taskStatus = new TaskStatus();
            $taskStatus->name = $value;
            $taskStatus->save();
        }
    }
}
