<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomIdStatus = random_int(1, count(TaskStatus::get()));

        $maxIdUser = count(User::all());
        $randomIdAssigned = User::find(random_int(1, $maxIdUser));

        $randomIdCreater = User::find(random_int(1, $maxIdUser));
        return [
            'status_id' =>  $randomIdStatus,
            'name' => fake()->unique()->name(),
            'description' => fake()->unique()->text(100),
            'created_by_id' => $randomIdCreater,
            'assigned_to_id' => $randomIdAssigned,
        ];
    }
}
