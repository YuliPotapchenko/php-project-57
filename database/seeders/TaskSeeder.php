<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'status_id' => 1,
                'name' => 'Исправить ошибку в какой-нибудь строке',
                'description' => 'Я тут ошибку нашёл, надо бы её исправить и так далее и так далее',
                'created_by_id' => 1,
                'assigned_to_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 2,
                'name' => 'Допилить дизайн главной страницы',
                'description' => 'Вёрстка поехала в далёкие края. Нужно удалить бутстрап!',
                'created_by_id' => 2,
                'assigned_to_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 3,
                'name' => 'Отрефакторить авторизацию',
                'description' => 'Выпилить всё легаси, которое найдёшь',
                'created_by_id' => 2,
                'assigned_to_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 4,
                'name' => 'Доработать команду подготовки БД',
                'description' => 'За одно добавить тестовых данных',
                'created_by_id' => 1,
                'assigned_to_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 1,
                'name' => 'Пофиксить вон ту кнопку',
                'description' => 'Кажется она не того цвета',
                'created_by_id' => 3,
                'assigned_to_id' => 4,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 2,
                'name' => 'Исправить поиск',
                'description' => 'Не ищет то, что мне хочется',
                'created_by_id' => 5,
                'assigned_to_id' => 6,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 3,
                'name' => 'Добавить интеграцию с облаками',
                'description' => 'Они такие мягкие и пушистые',
                'created_by_id' => 7,
                'assigned_to_id' => 8,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 4,
                'name' => 'Выпилить лишние зависимости',
                'description' => '',
                'created_by_id' => 9,
                'assigned_to_id' => 10,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 1,
                'name' => 'Запилить сертификаты',
                'description' => 'Кому-то же они нужны?',
                'created_by_id' => 11,
                'assigned_to_id' => 12,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 2,
                'name' => 'Выпилить игру престолов',
                'description' => 'Этот сериал никому не нравится! :)',
                'created_by_id' => 13,
                'assigned_to_id' => 14,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 4,
                'name' => 'Пофиксить спеку во всех репозиториях',
                'description' => 'Передать Олегу, чтобы больше не ронял прод',
                'created_by_id' => 2,
                'assigned_to_id' => 3,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 1,
                'name' => 'Вернуть крошки',
                'description' => 'Андрей, это задача для тебя',
                'created_by_id' => 4,
                'assigned_to_id' => 5,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 2,
                'name' => 'Установить Linux',
                'description' => 'Не забыть потестировать',
                'created_by_id' => 6,
                'assigned_to_id' => 7,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 3,
                'name' => 'Потребовать прибавки к зарплате',
                'description' => 'Кризис это не время, чтобы молчать!',
                'created_by_id' => 8,
                'assigned_to_id' => 9,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 4,
                'name' => 'Добавить поиск по фото',
                'description' => 'Только не по моему',
                'created_by_id' => 10,
                'assigned_to_id' => 11,
                'created_at' => Carbon::now(),
            ],
            [
                'status_id' => 1,
                'name' => 'Съесть еще этих прекрасных французских булочек',
                'description' => '',
                'created_by_id' => 13,
                'assigned_to_id' => 14,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
