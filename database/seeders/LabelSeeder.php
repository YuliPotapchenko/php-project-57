<?php

namespace Database\Seeders;

use App\Models\Label;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('labels')->insert([
             [
                 'name' => 'ошибка',
                 'description' => 'Какая-то ошибка в коде или проблема с функциональностью',
                 'created_at' => Carbon::now(),
             ],
             [
                 'name' => 'документация',
                 'description' => 'Задача которая касается документации',
                 'created_at' => Carbon::now(),
             ],
             [
                 'name' => 'дубликат',
                 'description' => 'Повтор другой задачи',
                 'created_at' => Carbon::now(),
             ],
             [
                 'name' => 'доработка',
                 'description' => 'Новая фича, которую нужно запилить',
                 'created_at' => Carbon::now(),
             ],
         ]);
    }
}
